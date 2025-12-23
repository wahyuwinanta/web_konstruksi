<?php

use Illuminate\Support\Facades\Route;

// Front Controllers
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CompanyAboutController;
use App\Http\Controllers\CompanyStatisticController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\OurPrincipleController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectClientController;
use App\Http\Controllers\TestimonialController;

// Auth & User Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerDashboardController;
// Project Controllers
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectAssignmentController;
use App\Http\Controllers\ProjectProgressController;
use App\Http\Controllers\TaskController;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/team', [FrontController::class, 'team'])->name('front.team');
Route::get('/about', [FrontController::class, 'about'])->name('front.about');
Route::get('/appointment', [FrontController::class, 'appointment'])->name('front.appointment');
Route::post('/appointment/store', [FrontController::class, 'appointment_store'])->name('front.appointment_store');


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:super_admin'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Admin Routes (Super Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Users
        Route::resource('users', UserController::class)->except('show');
        Route::patch('users/{user}/toggle', [UserController::class, 'toggle'])
            ->name('users.toggle');

        // Projects
        Route::resource('projects', ProjectController::class);
        Route::post('projects/{project}/assign', [ProjectAssignmentController::class, 'assignEmployee'])
            ->name('projects.assign');
        Route::delete('projects/{project}/assign/{user}', [ProjectAssignmentController::class, 'removeEmployee'])
            ->name('projects.removeEmployee');

        // Admin Modules
        Route::resources([
            'statistics'    => CompanyStatisticController::class,
            'products'      => ProductController::class,
            'principles'    => OurPrincipleController::class,
            'testimonials'  => TestimonialController::class,
            'clients'       => ProjectClientController::class,
            'teams'         => OurTeamController::class,
            'abouts'        => CompanyAboutController::class,
            'appointments'  => AppointmentController::class,
            'hero_sections' => HeroSectionController::class,
        ]);
    });

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('admin')
    ->name('profile.')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'editAdmin'])
            ->name('editAdmin');
    });

/*
|--------------------------------------------------------------------------
| Owner Routes
|--------------------------------------------------------------------------
*/
// OWNER ROUTES
Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        // Projects (navbar expects route('pekerja.projects'))
        Route::get('/projects', [OwnerDashboardController::class, 'myProjects'])
            ->name('projects');
        
        Route::patch('/projects/{project}/change-status', 
            [OwnerDashboardController::class, 'changeStatus'])
            ->name('projects.changeStatus');

        Route::get('/projects/{project}', [OwnerDashboardController::class, 'myProjectShow'])
            ->name('projects.show');

        Route::post('/projects/{project}/progress', [ProjectProgressController::class, 'store'])
            ->name('projects.progress.store');

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');

        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
            ->name('notifications.read');

        Route::get('/notifications/open/{id}', [NotificationController::class, 'open'])
            ->name('notifications.open');

        // Profile
        Route::get('/profile', [ProfileController::class, 'editOwner'])
            ->name('profile');

        Route::post('/projects/{project}/notes', [ProjectController::class, 'addNote'])
            ->name('projects.notes.store');

    });

Route::middleware(['auth', 'role:owner'])
    ->get('/owner', [OwnerDashboardController::class, 'dashboard'])
    ->name('owner.dashboard');

Route::middleware(['auth', 'role:owner']) 
    ->prefix('owner') 
    ->name('profile.') 
    ->group(function () 
    { Route::get('/profile', [ProfileController::class, 'editOwner']) 
        ->name('editOwner'); 
    });
/*
/*
|--------------------------------------------------------------------------
| Pekerja Routes
|--------------------------------------------------------------------------
*/

// Dashboard

Route::middleware(['auth', 'role:pekerja'])
    ->get('/pekerja', [ProjectController::class, 'dashboard'])
    ->name('pekerja.dashboard');

Route::middleware(['auth', 'role:pekerja'])
    ->prefix('pekerja')
    ->name('pekerja.')
    ->group(function () {
 
        Route::resource('projects', ProjectController::class);

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');

        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
            ->name('notifications.read');

        Route::get('/notifications/open/{id}', [NotificationController::class, 'open'])
            ->name('notifications.open');

        // Projects (navbar expects route('pekerja.projects'))
        Route::get('/projects', [ProjectController::class, 'myProjects'])
            ->name('projects');

        Route::get('/projects/{project}', [ProjectController::class, 'myProjectShow'])
            ->name('projects.show');

        Route::post('/projects/{project}/progress', [ProjectProgressController::class, 'store'])
            ->name('projects.progress.store');

        // Profile (navbar expects route('pekerja.profile'))
        Route::get('/profile', [ProfileController::class, 'editPekerja'])
            ->name('profile');

        Route::post('/pekerja/projects/{project}/notes',[ProjectController::class, 'addNote'])
            ->name('pekerja.projects.add-note');

    });

// Profile Routes
Route::middleware(['auth', 'role:pekerja']) 
    ->prefix('pekerja') 
    ->name('profile.') 
    ->group(function () 
    { Route::get('/profile', [ProfileController::class, 'editPekerja']) 
        ->name('editPekerja'); 
    });

/*
|--------------------------------------------------------------------------
| Profile Update Route (All Roles)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

Route::post('/notifications/mark-all-read', 
    [NotificationController::class, 'markAllRead']
)->name('notifications.readAll');


/*
|--------------------------------------------------------------------------
| Auth Scaffolding
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
