<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function downloadResume(Request $request, Resume $resume)
    {
        $user = auth()->user();

        // Server-side Authorization Check
        $isAuthorized = false;

        if ($user->hasRole('admin')) {
            $isAuthorized = true;
        } elseif ($user->id === $resume->user_id) {
            $isAuthorized = true;
        } elseif ($user->hasRole('company') && $user->company) {
            // Check if candidate applied to any of this company's jobs
            $companyJobIds = $user->company->jobs()->pluck('id');
            $hasApplied = Application::whereIn('job_posting_id', $companyJobIds)
                ->where('user_id', $resume->user_id)
                ->exists();
            if ($hasApplied) {
                $isAuthorized = true;
            }
        }

        if (!$isAuthorized) {
            abort(403, 'Unauthorized file access.');
        }

        // Prevent path traversal
        $safePath = ltrim(str_replace(['../', '..\\'], '', $resume->file_path), '/\\');

        $extension = pathinfo($resume->original_name ?: $safePath, PATHINFO_EXTENSION) ?: 'pdf';
        $baseName = pathinfo($resume->original_name ?: 'CV_' . $resume->id, PATHINFO_FILENAME);
        $cleanBase = preg_replace('/[^\w\s\d\-_~]/u', '', $baseName) ?: 'CV_' . $resume->id;
        $downloadName = $cleanBase . '.' . $extension;

        if (Storage::disk('local')->exists($safePath)) {
            return Storage::disk('local')->download($safePath, $downloadName);
        }

        if (Storage::disk('public')->exists($safePath)) {
            return Storage::disk('public')->download($safePath, $downloadName);
        }

        $realPath = storage_path('app/private/' . $safePath);
        if (!file_exists($realPath)) {
            $realPath = storage_path('app/' . $safePath);
        }
        if (!file_exists($realPath)) {
            $realPath = storage_path('app/public/' . $safePath);
        }

        if (file_exists($realPath) && is_file($realPath)) {
            return response()->download($realPath, $downloadName);
        }

        abort(404, 'File not found.');
    }

    public function downloadRecommendation(Request $request, User $user)
    {
        $authUser = auth()->user();

        // Recommendation letters contain sensitive church/confession details: Only Admin or the User themselves
        if (!$authUser->hasRole('admin') && $authUser->id !== $user->id) {
            abort(403, 'Unauthorized file access.');
        }

        if (!$user->recommendation_letter) {
            abort(404, 'Recommendation letter not found.');
        }

        $safePath = ltrim(str_replace(['../', '..\\'], '', $user->recommendation_letter), '/\\');

        $extension = pathinfo($safePath, PATHINFO_EXTENSION) ?: 'pdf';
        $downloadName = 'Recommendation_' . $user->id . '.' . $extension;

        if (Storage::disk('local')->exists($safePath)) {
            return Storage::disk('local')->download($safePath, $downloadName);
        }

        if (Storage::disk('public')->exists($safePath)) {
            return Storage::disk('public')->download($safePath, $downloadName);
        }

        $realPath = storage_path('app/private/' . $safePath);
        if (!file_exists($realPath)) {
            $realPath = storage_path('app/' . $safePath);
        }
        if (!file_exists($realPath)) {
            $realPath = storage_path('app/public/' . $safePath);
        }

        if (file_exists($realPath) && is_file($realPath)) {
            return response()->download($realPath, $downloadName);
        }

        abort(404, 'File not found.');
    }
}
