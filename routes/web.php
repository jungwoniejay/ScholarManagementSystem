<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\StudentScholarshipController;
use App\Http\Controllers\StudentWalletController;
use App\Http\Controllers\DonorApplicationController;
use App\Http\Controllers\DonationController;
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
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\LandingPageController;
use App\Http\Controllers\Admin\CookieSettingsController;
use App\Http\Controllers\Admin\MaintenanceController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/credentials', function () {
    return view('credentials');
})->name('credentials');

Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [PageController::class, 'termsAndConditions'])->name('terms-and-conditions');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return match(auth()->user()->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'donator' => redirect()->route('donator.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default   => redirect()->route('login'),
    };
})->middleware('auth')->name('dashboard');

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
| Student Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

        // Scholarships
        Route::get('/scholarships', [StudentScholarshipController::class, 'index'])->name('scholarships.index');
        Route::get('/scholarships/awarded', [StudentScholarshipController::class, 'awarded'])->name('scholarships.awarded');
        Route::get('/scholarships/status', [StudentScholarshipController::class, 'status'])->name('scholarships.status');
        Route::get('/scholarships/{scholarship}', [StudentScholarshipController::class, 'show'])->name('scholarships.show');
        Route::post('/scholarships/{application}/respond', [StudentScholarshipController::class, 'respond'])->name('scholarships.respond');

        // Applications
        Route::get('/applications', [StudentApplicationController::class, 'index'])->name('applications.index');
        Route::post('/applications', [StudentApplicationController::class, 'store'])->name('applications.store');

        // Documents
        Route::get('/documents', [StudentDocumentController::class, 'index'])->name('documents.index');
        Route::post('/documents', [StudentDocumentController::class, 'store'])->name('documents.store');

        // Wallet
        Route::get('/wallet', [StudentWalletController::class, 'index'])->name('wallet.index');
        Route::get('/wallet/withdraw', [StudentWalletController::class, 'withdrawForm'])->name('wallet.withdraw');
        Route::post('/wallet/withdraw', [StudentWalletController::class, 'withdraw'])->name('wallet.withdraw.submit');
    });

/*
|--------------------------------------------------------------------------
| Donator Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:donator'])
    ->prefix('donator')
    ->name('donator.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('donator.dashboard');
        })->name('dashboard');

        // Applications assigned to donor
        Route::get('/applications', [DonorApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/awaiting-response', [DonorApplicationController::class, 'awaitingResponse'])->name('applications.awaiting-response');
        Route::get('/applications/awarded', [DonorApplicationController::class, 'awarded'])->name('applications.awarded');
        Route::get('/applications/{application}', [DonorApplicationController::class, 'show'])->name('applications.show');
        Route::post('/applications/{application}/decision', [DonorApplicationController::class, 'updateDecision'])->name('applications.decision');

        // Donations
        Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
        Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
        Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
        Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('donations.show');
        Route::get('/donations/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');
        Route::put('/donations/{donation}', [DonationController::class, 'update'])->name('donations.update');
        Route::delete('/donations/{donation}', [DonationController::class, 'destroy'])->name('donations.destroy');
    });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Search
        Route::get('/search', [SearchController::class, 'index'])->name('search');

        // Students
        Route::resource('students', StudentController::class);

        // Donators
        Route::resource('donators', DonatorController::class);

        // Scholarships
        Route::resource('scholarships', ScholarshipController::class);
        Route::patch('scholarships/{scholarship}/approve', [ScholarshipController::class, 'approve'])->name('scholarships.approve');
        Route::patch('scholarships/{scholarship}/reject', [ScholarshipController::class, 'reject'])->name('scholarships.reject');

        // Rules
        Route::resource('rules', RuleController::class);

        // Reports
        Route::resource('reports', ReportController::class);

        // Admin Accounts
        Route::resource('accounts', AdminAccountController::class);

        // Courses
        Route::resource('courses', CourseController::class);

        // Announcements
        Route::resource('announcements', AnnouncementController::class);

        // Applications
        Route::get('applications/pending', [ApplicationController::class, 'pending'])->name('applications.pending');
        Route::get('applications/screened', [ApplicationController::class, 'screened'])->name('applications.screened');
        Route::get('applications/review', [ApplicationController::class, 'review'])->name('applications.review');
        Route::get('applications/shortlist', [ApplicationController::class, 'shortlist'])->name('applications.shortlist');
        Route::get('applications/completed', [ApplicationController::class, 'completed'])->name('applications.completed');
        Route::get('applications/rejected', [ApplicationController::class, 'rejected'])->name('applications.rejected');
        Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
        Route::patch('applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');

        // Documents
        Route::get('documents/verify', [DocumentController::class, 'verify'])->name('documents.verify');
        Route::patch('documents/{document}/approve', [DocumentController::class, 'approve'])->name('documents.approve');
        Route::patch('documents/{document}/reject', [DocumentController::class, 'reject'])->name('documents.reject');

        // Funds
        Route::get('funds/monitor', [FundController::class, 'monitor'])->name('funds.monitor');

        // Donations
        Route::get('donations', [AdminDonationController::class, 'index'])->name('donations.index');
        Route::get('donations/export', [AdminDonationController::class, 'export'])->name('donations.export');
        Route::get('donations/{donation}', [AdminDonationController::class, 'show'])->name('donations.show');
        Route::patch('donations/{donation}/approve', [AdminDonationController::class, 'approve'])->name('donations.approve');
        Route::patch('donations/{donation}/reject', [AdminDonationController::class, 'reject'])->name('donations.reject');

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'all'])->name('notifications.all');

        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

        // Activity Monitoring
        Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
        Route::get('/activity/export/csv', [ActivityController::class, 'exportCsv'])->name('activity.export.csv');
        Route::get('/activity/export/json', [ActivityController::class, 'exportJson'])->name('activity.export.json');
        Route::get('/activity/{activity}', [ActivityController::class, 'show'])->name('activity.show');

        // Landing Page
        Route::get('/landing', [LandingPageController::class, 'edit'])->name('landing.edit');
        Route::put('/landing', [LandingPageController::class, 'update'])->name('landing.update');

        // Cookie Settings
        Route::get('/cookies', [CookieSettingsController::class, 'index'])->name('cookies.index');
        Route::post('/cookies', [CookieSettingsController::class, 'update'])->name('cookies.update');

        // Maintenance
        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::post('/maintenance/export', [MaintenanceController::class, 'export'])->name('maintenance.export');
        Route::post('/maintenance/clear-cache', [MaintenanceController::class, 'clearCache'])->name('maintenance.clear-cache');
    });

/*
|--------------------------------------------------------------------------
| Language Routes
|--------------------------------------------------------------------------
*/

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es', 'fr'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/system-flow', function () {
    return view('system-flow');
})->middleware('auth')->name('system.flow');

require __DIR__ . '/auth.php';
