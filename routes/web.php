<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;

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

// root
Route::get('/', function () {
    return view('main');
});

// テンプレートとして以下用意したので、必要に応じてコメントアウトを外して下さい。また、不要な場合は削除してください。
// global-pages / user-login / user-registration / admin-login / admin-pages

// global pages
Route::get('/about', [MainController::class, 'about'])->name('about');

Route::prefix('/shop')->group(function () {
    Route::get('/', function () { return 'This is shop shop page'; })->name('shop');
    // Route::get('/lists', [ShopController::class, 'listView'])->name('shop.list');
    // Route::get('/detail', [ShopController::class, 'detail'])->name('shop.detail');
});

Route::prefix('/blog')->group(function () {
    Route::get('/', function () { return 'This is blog page'; })->name('blog');
    // Route::get('/lists', [BlogController::class, 'listView'])->name('blog.list');
    // Route::post('/post', [ShopController::class, 'postBlog'])->name('blog.post');
});

// User login pages
// Route::get('/login', [User\LoginController::class, 'loginView'])->name('login.view');
// Route::post('/login', [User\LoginController::class, 'login'])->name('login');

// User registration pages
Route::prefix('/registration')->group(function () {
    // Route::get('/', [User\RegistrationController::class, 'registView'])->name('regist.view');
    // Route::post('/confirm', [User\RegistrationController::class, 'registConfirm'])->name('regist.confirm');
    // Route::post('/regist', [User\RegistrationController::class, 'regist'])->name('regist');
    // Route::get('/succeeded', [User\RegistrationController::class, 'registSuccessView'])->name('regist-success.view);
});

// After Login
// Route::middlewaret('auth:users')->group(function () {
// with mail verified
Route::middleware('verified')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('user.home');

    Route::prefix('/profile')->group(function () {
        // Route::get('/password-edit', [User\ProfileController::class, 'passwordView'])->name('password.view');
        // Route::post('/password-edit' [User\ProfileController::class, 'passwordConfirm'])->name('password.confirm);
        // Route::post('/password-update' [User\ProfileController::class, 'passwordUpdate'])->name('password.update);
        // Route::get('/edit', [User\ProfileController::class, 'editProfileView'])->name('profile.view');
        // Route::post('/edit' [User\ProfileController::class, 'profileConfirm'])->name('profile.confirm);
        // Route::post('/update' [User\ProfileController::class, 'profileUpdate'])->name('profile.update);
    });
});

// Admin Login
Route::prefix('/admin')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('admin.login.index');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');
});

// Admin After Login
Route::prefix('/admin')->middleware('auth.admin:administrators')->group(function () {
    Route::view('/dashboard', 'admin/dashboard')->name('admin.dashboard.index');

    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::prefix('/profile')->group(function () {
        // Route::get('/password-edit', [Admin\ProfileController::class, 'passwordView'])->name('password.view');
        // Route::post('/password-edit' [Admin\ProfileController::class, 'passwordConfirm'])->name('password.confirm);
        // Route::post('/password-update' [Admin\ProfileController::class, 'passwordUpdate'])->name('password.update);
        // Route::get('/edit', [Admin\ProfileController::class, 'editProfileView'])->name('profile.view');
        // Route::post('/edit' [Admin\ProfileController::class, 'profileConfirm'])->name('profile.confirm);
        // Route::post('/update' [Admin\ProfileController::class, 'profileUpdate'])->name('profile.update);
    });

    // Route::prefix('/blog')->group(function () {
        // Route::get('list', [Admin\BlogController::class, 'blogList'])->name('admin.blog.list);
    // });

});

Route::view('/test', 'test');
// if you want test with parameter
// Route::view('/test', 'test', ['foo' => 'bar']);
