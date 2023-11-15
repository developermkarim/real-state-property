<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User Frontend All Route
Route::get('/', [UserController::class, 'Index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','role:user'])->group(function () {
    Route::get('user/profile', [ProfileController::class, 'edit'])->name('user.profile');
    Route::patch('user/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('user/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');

 Route::prefix('user/')->name('user.')->controller(UserController::class)->group(function(){
 /*    Route::get('dashboard','UserDashboard')->name('dashboard'); */

    Route::get('logout', 'UserLogout')->name('logout');

    Route::get('dashboard','UserProfile')->name('dashboard');
    Route::post('profile/store','UserProfileStore')->name('profile.store');

    Route::get('change/password', 'UserChangePassword')->name('change.password');

    Route::post('password/update','UserPasswordUpdate')->name('update.password');
});

});

require __DIR__.'/auth.php';

/* My Custom Route Here all */

/* Admin Middleware Route Here */
Route::prefix('admin/')->name('admin.')->middleware(['auth','role:admin'])->controller(AdminController::class)->group(function(){

    Route::get('/dashboard','AdminDashboard')->name('dashboard');

    Route::get('/logout', 'AdminLogout')->name('logout');

    Route::get('/profile','AdminProfile')->name('profile');
    Route::post('/profile/store','AdminProfileStore')->name('profile.store');

    Route::get('/change/password', 'AdminChangePassword')->name('change.password');

    Route::post('/update/password','AdminUpdatePassword')->name('update.password');

});

/* Agent Middleware Route Here */

Route::prefix('agent/')->name('agent.')->middleware(['auth','role:agent'])->controller(AgentController::class)->group(function(){

    Route::get('dashboard','AgentDashboard')->name('dashboard');

    Route::get('logout', 'AgentLogout')->name('logout');

    Route::get('profile','AgentProfile')->name('profile');
    Route::post('profile/store','AgentProfileStore')->name('profile.store');

    Route::get('change/password', 'AgentChangePassword')->name('change.password');

    Route::post('update/password','AgentUpdatePassword')->name('update.password');

});

/* Redirect To Dashboard after Login  Start */
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);

Route::post('agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');

/* Redirect To Dashboard after Login  End */
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

/* Agent Middleware Route Here */
Route::middleware(['auth','role:agent'])->group(function(){
Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});
