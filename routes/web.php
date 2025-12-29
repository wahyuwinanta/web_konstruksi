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
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\PimpinanDashboardController;
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
Route::middleware(['auth', 'role:admin'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Admin Routes (Super Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
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

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('profile.')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'editAdmin'])
            ->name('editAdmin');
    });

/*
|--------------------------------------------------------------------------
| Pimpinan Routes
|--------------------------------------------------------------------------
*/
// PIMPINAN ROUTES
Route::middleware(['auth', 'role:pimpinan'])
    ->prefix('pimpinan')
    ->name('pimpinan.')
    ->group(function () {

        // Projects (navbar expects route('pegawai.projects'))
        Route::get('/projects', [PimpinanDashboardController::class, 'myProjects'])
            ->name('projects');
        
        Route::patch('/projects/{project}/change-status', 
            [PimpinanDashboardController::class, 'changeStatus'])
            ->name('projects.changeStatus');

        Route::get('/projects/{project}', [PimpinanDashboardController::class, 'myProjectShow'])
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
        Route::get('/profile', [ProfileController::class, 'editPimpinan'])
            ->name('profile');

        Route::post('/projects/{project}/notes', [ProjectController::class, 'addNote'])
            ->name('projects.notes.store');

    });

Route::middleware(['auth', 'role:pimpinan'])
    ->get('/pimpinan', [PimpinanDashboardController::class, 'dashboard'])
    ->name('pimpinan.dashboard');

Route::middleware(['auth', 'role:pimpinan']) 
    ->prefix('pimpinan') 
    ->name('profile.') 
    ->group(function () 
    { Route::get('/profile', [ProfileController::class, 'editPimpinan']) 
        ->name('editPimpinan'); 
    });
/*
/*
|--------------------------------------------------------------------------
| pegawai Routes
|--------------------------------------------------------------------------
*/

// Dashboard

Route::middleware(['auth', 'role:pegawai'])
    ->get('/pegawai', [ProjectController::class, 'dashboard'])
    ->name('pegawai.dashboard');

Route::middleware(['auth', 'role:pegawai'])
    ->prefix('pegawai')
    ->name('pegawai.')
    ->group(function () {
 
        Route::resource('projects', ProjectController::class);

        // Notifications
        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');

        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
            ->name('notifications.read');

        Route::get('/notifications/open/{id}', [NotificationController::class, 'open'])
            ->name('notifications.open');

        // Projects (navbar expects route('pegawai.projects'))
        Route::get('/projects', [ProjectController::class, 'myProjects'])
            ->name('projects');

        Route::get('/projects/{project}', [ProjectController::class, 'myProjectShow'])
            ->name('projects.show');

        Route::post('/projects/{project}/progress', [ProjectProgressController::class, 'store'])
            ->name('projects.progress.store');

        // Profile (navbar expects route('pegawai.profile'))
        Route::get('/profile', [ProfileController::class, 'editPegawai'])
            ->name('profile');

        Route::post('/pegawai/projects/{project}/notes',[ProjectController::class, 'addNote'])
            ->name('pegawai.projects.add-note');

    });

// Profile Routes
Route::middleware(['auth', 'role:pegawai']) 
    ->prefix('pegawai') 
    ->name('profile.') 
    ->group(function () 
    { Route::get('/profile', [ProfileController::class, 'editPegawai']) 
        ->name('editPegawai'); 
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
