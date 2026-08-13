<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resume;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::role('seeker');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('religion')) {
            $query->where('religion', $request->religion);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('status')) {
            $query->where('application_status', $request->status);
        }

        $totalUsersCount = \Illuminate\Support\Facades\Cache::remember('seekers_total_count', 900, fn() => User::role('seeker')->count());
        $pendingUsersCount = \Illuminate\Support\Facades\Cache::remember('seekers_pending_count', 900, fn() => User::role('seeker')->where('application_status', 'pending')->count());
        $reviewedUsersCount = \Illuminate\Support\Facades\Cache::remember('seekers_reviewed_count', 900, fn() => User::role('seeker')->where('application_status', 'reviewed')->count());
        $cvCount = \Illuminate\Support\Facades\Cache::remember('resumes_total_count', 900, fn() => Resume::count());

        $users = $query->with('resumes')->latest()->paginate(15)->withQueryString();
        
        return view('admin.users.index', compact('users', 'totalUsersCount', 'pendingUsersCount', 'reviewedUsersCount', 'cvCount'));
    }

    public function show(User $user)
    {
        $user->load('resumes');
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'location' => $request->location,
            'religion' => $request->religion,
            'nationality' => $request->nationality,
            'birth_date' => $request->birth_date,
            'education_status' => $request->education_status,
            'education_degree' => $request->education_degree,
        ]);

        $user->forceFill(['application_status' => 'pending'])->save();

        $seekerRole = Role::where('name', 'seeker')->first();
        if ($seekerRole) {
            $user->assignRole($seekerRole);
        }

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $path = $file->store('cvs', 'local'); // Store securely in private local disk

            Resume::create([
                'user_id' => $user->id,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', __('User created successfully.'));
    }

    public function markReviewed(User $user)
    {
        $user->forceFill(['application_status' => 'reviewed'])->save();
        return back()->with('success', __('User application marked as reviewed.'));
    }

    public function updateNotes(Request $request, User $user)
    {
        $request->validate([
            'admin_rating' => 'nullable|integer|min:1|max:5',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $user->update([
            'admin_rating' => $request->admin_rating,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', __('Candidate evaluation and private notes updated successfully!'));
    }

    public function exportExcel(Request $request)
    {
        $query = User::role('seeker');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('religion')) {
            $query->where('religion', $request->religion);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('status')) {
            $query->where('application_status', $request->status);
        }

        $users = $query->latest()->lazy();

        $filename = 'malak-careers-users-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $columns = [
            'م',
            'الاسم الأول',
            'الاسم الأخير',
            'البريد الإلكتروني',
            'رقم الهاتف',
            'الموقع',
            'الجنس',
            'تاريخ الميلاد',
            'الديانة',
            'الجنسية',
            'الحالة الدراسية',
            'المؤهل الدراسي',
            'المسمى الوظيفي',
            'سنوات الخبرة',
            'نوع العمل',
            'حالة التوظيف',
            'اللغات',
            'مهارات الكمبيوتر (MS Office)',
            'الشركة الحالية',
            'آخر مرتب',
            'تفاصيل الخبرة',
            'LinkedIn',
            'أبونا المعترف وكنيسته',
            'كنيسة المتقدم',
            'تاريخ التقديم',
            'حالة الطلب',
            'تاريخ الانضمام',
        ];

        $callback = function() use ($users, $columns) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM for proper Arabic display in Excel
            fputs($file, "\xEF\xBB\xBF");

            fputcsv($file, $columns);

            foreach ($users as $index => $user) {
                fputcsv($file, [
                    $index + 1,
                    $user->first_name,
                    $user->last_name,
                    $user->email,
                    $user->phone,
                    $user->location,
                    $user->gender === 'male' ? 'ذكر' : ($user->gender === 'female' ? 'أنثى' : ''),
                    $user->birth_date ? $user->birth_date->format('Y-m-d') : '',
                    $user->religion,
                    $user->nationality,
                    $user->education_status,
                    $user->education_degree,
                    $user->headline,
                    $user->years_of_experience,
                    $user->worker_type,
                    $user->employment_status,
                    is_array($user->languages) ? implode(', ', $user->languages) : $user->languages,
                    $user->microsoft_office_skills,
                    $user->current_company,
                    $user->last_salary,
                    $user->experience_details,
                    $user->linkedin_url,
                    $user->confession_father,
                    $user->applicant_church,
                    $user->application_date ? $user->application_date->format('Y-m-d') : '',
                    $user->application_status,
                    $user->created_at->format('Y-m-d H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportCvs(Request $request)
    {
        $query = User::role('seeker');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('religion')) {
            $query->where('religion', $request->religion);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('status')) {
            $query->where('application_status', $request->status);
        }

        $users = $query->with('resumes')->lazy();

        $zip = new \ZipArchive();
        $zipFileName = 'malak-careers-cvs-' . now()->format('Y-m-d_H-i-s') . '.zip';
        $zipFilePath = storage_path('app/' . $zipFileName);

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return back()->with('error', __('Failed to create ZIP archive.'));
        }

        $addedCount = 0;

        foreach ($users as $user) {
            foreach ($user->resumes as $resume) {
                // Ensure no path traversal in file_path
                $safeRelativePath = ltrim(str_replace(['../', '..\\'], '', $resume->file_path), '/\\');
                $diskPath = storage_path('app/private/' . $safeRelativePath);
                if (!file_exists($diskPath)) {
                    $diskPath = storage_path('app/' . $safeRelativePath);
                }
                if (!file_exists($diskPath)) {
                    $diskPath = storage_path('app/public/' . $safeRelativePath);
                }
                if (!file_exists($diskPath)) {
                    $diskPath = public_path('storage/' . $safeRelativePath);
                }

                if (file_exists($diskPath) && is_file($diskPath)) {
                    $cleanName = preg_replace('/[^\w\s\d\-_~]/u', '', $user->name);
                    $cleanName = trim($cleanName) ?: 'User_' . $user->id;
                    $extension = pathinfo($resume->original_name ?: $resume->file_path, PATHINFO_EXTENSION) ?: 'pdf';
                    $entryName = "{$cleanName}_CV_{$user->id}.{$extension}";

                    $zip->addFile($diskPath, $entryName);
                    $addedCount++;
                }
            }
        }

        $zip->close();

        if ($addedCount === 0) {
            if (file_exists($zipFilePath)) {
                @unlink($zipFilePath);
            }
            return back()->with('error', __('No CV documents found for the selected users.'));
        }

        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', __('User deleted successfully.'));
    }
}
