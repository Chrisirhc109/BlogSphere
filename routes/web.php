<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Apps\PermissionManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('dashboard');
    
    Route::post('/create-post',[PostController::class,'createPost'])->name('posts.store');
    Route::put('/edit-post/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/delete-post/{post}',[PostController::class,'deletePost']);
    Route::get('/search',[PostController::class,'search']);

    //Profile
    Route::get('/profile',[UserController::class,'profile'])->name('profile');

    //Graphs
    Route::get('/graph',[GraphController::class,'linechart'])->name('line-graph.show');
    Route::get('/UserCreation',[GraphController::class,'userCreation'])->name('TableGraph.show');

    // Profile
    Route::get('/profile', function () {
        return view('partials.profile.profPage');
    })->middleware('auth')->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

    // User management routes
    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    // Catch-all route for the dashboard
    Route::get('/', function () {
        $posts = Post::latest()->get();
        return view('pages.dashboards.index', ['posts' => $posts]);
    })->name('dashboard');
});


// Error route
Route::get('/error', function () {
    abort(500);
});

// Socialite redirect route
Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

// Authentication routes
require __DIR__ . '/auth.php';
