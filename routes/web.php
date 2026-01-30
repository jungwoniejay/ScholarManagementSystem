<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\DonatorController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\FundController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SettingsController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', function () {
            return view('dashboard'); 
        })->name('dashboard');

        // Search
        Route::get('/search', [SearchController::class, 'index'])->name('search');

        // Resources
        Route::resource('students', StudentController::class);
        Route::resource('donators', DonatorController::class);
        Route::resource('scholarships', ScholarshipController::class);
        Route::resource('rules', RuleController::class);
        Route::resource('reports', ReportController::class);
        Route::resource('accounts', AdminAccountController::class);

        // Applications
        Route::get('applications/{application}', [ApplicationController::class, 'show'])
            ->name('applications.show');

        Route::get('applications/screened', [ApplicationController::class, 'screened'])
            ->name('applications.screened');

        Route::get('applications/review', [ApplicationController::class, 'review'])
            ->name('applications.review');

        Route::get('applications/shortlist', [ApplicationController::class, 'shortlist'])
            ->name('applications.shortlist');

        // Documents
        Route::get('documents/verify', [DocumentController::class, 'verify'])
            ->name('documents.verify');

        // Funds
        Route::get('funds/monitor', [FundController::class, 'monitor'])
            ->name('funds.monitor');

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'all'])
            ->name('notifications.all');

        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])
            ->name('settings');

        Route::post('/settings', [SettingsController::class, 'update'])
            ->name('settings.update');
    });

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
