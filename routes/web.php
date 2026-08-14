<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompleteProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/language-switch/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session()->put('locale', $locale);
        session()->save();
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified', 'profile.complete'])->name('dashboard');

// Google OAuth profile completion (must be accessible before profile is complete)
Route::middleware('auth')->group(function () {
    Route::get('/complete-profile', [CompleteProfileController::class, 'show'])->name('profile.complete');
    Route::post('/complete-profile', [CompleteProfileController::class, 'save'])->middleware('throttle:10,1')->name('profile.complete.save');
});

Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/cv-builder', [ProfileController::class, 'previewCv'])->name('profile.cvBuilder');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/resumes/{resume}/download', [\App\Http\Controllers\FileDownloadController::class, 'downloadResume'])->name('resumes.download');
    Route::get('/users/{user}/recommendation', [\App\Http\Controllers\FileDownloadController::class, 'downloadRecommendation'])->name('users.recommendation.download');
    Route::post('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/export', [\App\Http\Controllers\Admin\UserController::class, 'exportExcel'])->name('users.export');
    Route::get('/users/export-cvs', [\App\Http\Controllers\Admin\UserController::class, 'exportCvs'])->name('users.exportCvs');
    Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/mark-reviewed', [\App\Http\Controllers\Admin\UserController::class, 'markReviewed'])->name('users.markReviewed');
    Route::patch('/users/{user}/notes', [\App\Http\Controllers\Admin\UserController::class, 'updateNotes'])->name('users.updateNotes');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/jobs', [\App\Http\Controllers\Admin\JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [\App\Http\Controllers\Admin\JobController::class, 'show'])->name('jobs.show');
    Route::delete('/jobs/{job}', [\App\Http\Controllers\Admin\JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/jobs/{job}/nominate', [\App\Http\Controllers\Admin\JobController::class, 'nominate'])->name('jobs.nominate');
    Route::post('/jobs/{job}/nominate', [\App\Http\Controllers\Admin\JobController::class, 'storeNominations'])->name('jobs.nominate.store');

    Route::get('/companies', [\App\Http\Controllers\Admin\CompanyController::class, 'index'])->name('companies.index');
    Route::patch('/companies/{company}/verify', [\App\Http\Controllers\Admin\CompanyController::class, 'verify'])->name('companies.verify');
    Route::patch('/companies/{company}/reject', [\App\Http\Controllers\Admin\CompanyController::class, 'reject'])->name('companies.reject');
    Route::delete('/companies/{company}', [\App\Http\Controllers\Admin\CompanyController::class, 'destroy'])->name('companies.destroy');
});

Route::middleware(['auth', 'role:company'])->prefix('company')->name('company.')->group(function () {
    Route::get('/jobs', [\App\Http\Controllers\Company\JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [\App\Http\Controllers\Company\JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [\App\Http\Controllers\Company\JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}', [\App\Http\Controllers\Company\JobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{job}/edit', [\App\Http\Controllers\Company\JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [\App\Http\Controllers\Company\JobController::class, 'update'])->name('jobs.update');
    
    // Application Status Update
    Route::patch('/applications/{application}/status', [\App\Http\Controllers\Company\ApplicationController::class, 'updateStatus'])->name('applications.status');
});

Route::get('/auth/google', [\App\Http\Controllers\Auth\SocialLoginController::class, 'redirectToGoogle'])->name('auth.google')->middleware('throttle:10,1');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\SocialLoginController::class, 'handleGoogleCallback'])->middleware('throttle:10,1');



require __DIR__.'/auth.php';
