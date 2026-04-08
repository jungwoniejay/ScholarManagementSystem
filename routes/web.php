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
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\DonationController;
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

    return match(auth()->user()->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'donator' => redirect()->route('donator.dashboard'),
        'student' => redirect()->route('student.dashboard'),
    };

})->middleware('auth')->name('dashboard');
//admin dashboard
Route::middleware(['auth','role:admin'])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::view('/dashboard','admin.dashboard')
        ->name('dashboard');

});
//donator dashboard
Route::middleware(['auth','role:donator'])
->prefix('donator')
->name('donator.')
->group(function () {

    Route::view('/dashboard','donator.dashboard')
        ->name('dashboard');

});
//student dashboard
Route::middleware(['auth','role:student'])
->prefix('student')
->name('student.')
->group(function () {

    Route::view('/dashboard','student.dashboard')
        ->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| Donator Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/donator/dashboard', function () {
    return view('donator.dashboard');
})->middleware(['auth'])->name('donator.dashboard');

/*
|--------------------------------------------------------------------------
| Student Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth'])->name('student.dashboard');

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

Route::middleware('auth')->group(function () {
    Route::get('/applications', [StudentApplicationController::class, 'index'])->name('applications.index');
    Route::get('/documents', [StudentDocumentController::class, 'index'])->name('documents.index');
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
            $totalDonors = \App\Models\Donator::count();
            $totalDonorFunds = \App\Models\Donator::sum('total_fund');
            return view('dashboard', compact('totalDonors', 'totalDonorFunds'));
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

        // Donations
        Route::get('donations', [AdminDonationController::class, 'index'])
            ->name('donations.index');

        Route::get('donations/{donation}', [AdminDonationController::class, 'show'])
            ->name('donations.show');

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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('donators', [DonationController::class, 'index'])
    ->name('donators');

Route::post('donators/store', [DonationController::class, 'store'])
    ->name('donators.store');

Route::get('donators/create', [DonationController::class, 'create'])
    ->name('donators.create');

Route::get('donators/{donation}/edit', [DonationController::class, 'edit'])
    ->name('donators.edit');

Route::put('donators/{donation}', [DonationController::class, 'update'])
    ->name('donators.update');

Route::delete('donators/{donation}', [DonationController::class, 'destroy'])
    ->name('donators.destroy');

Route::get('donators/{donation}', [DonationController::class, 'show'])
    ->name('donators.show');
require __DIR__ . '/auth.php';
