<?php

use App\Http\Controllers\GraphController;
use App\Http\Controllers\PDFController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Apps\PermissionManagementController;
use mikehaertl\wkhtmlto\Pdf;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/create-post',[PostController::class,'createPost']);
    Route::put('/edit-post/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/delete-post/{post}',[PostController::class,'deletePost']);
    Route::get('/search',[PostController::class,'search']);


    Route::get('/graph',[GraphController::class,'linechart'])->name('line-graph.show');
    
    Route::get('/graphgoo',[GraphController::class,'barchartGOOGLE'])->name('google-graph.show');

    Route::get('/ThreeD',[GraphController::class,'threeD'])->name('3d-graph.show');

    Route::get('/Tigad',[GraphController::class,'Tigad'])->name('3d.show');


    // User management routes
    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    // Catch-all route for the dashboard
    Route::get('/', function () {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
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
