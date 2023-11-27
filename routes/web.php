<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AdminController;
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
Route::middleware(['auth','role:admin'])->group(function(){

Route::prefix('admin/')->name('admin.')->controller(AdminController::class)->group(function(){

    Route::get('/dashboard','AdminDashboard')->name('dashboard');

    Route::get('/logout', 'AdminLogout')->name('logout');

    Route::get('/profile','AdminProfile')->name('profile');
    Route::post('/profile/store','AdminProfileStore')->name('profile.store');

    Route::get('/change/password', 'AdminChangePassword')->name('change.password');

    Route::post('/update/password','AdminUpdatePassword')->name('update.password');

});

Route::controller(AdminController::class)->group(function () {

        /* Agent Manage Here */
    Route::get('agent/all','AllAgent')->name('all.agent');

    Route::get('agent/add','AddAgent')->name('add.agent');

    Route::post('agent/store', 'StoreAgent')->name('store.agent');

    Route::get('agent/edit/{id}','EditAgent')->name('edit.agent');

    Route::get('agent/delete/{id}','DeleteAgent')->name('delete.agent');

    Route::post('agent/status','ChangeStatus')->name('agent.status');
});

 // Property Type All Route
 Route::controller(PropertyTypeController::class)->group(function(){

    Route::get('/all/type', 'AllType')->name('all.type');
    Route::get('/add/type', 'AddType')->name('add.type');
    Route::post('/store/type', 'StoreType')->name('store.type');
    Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
    Route::post('/update/type', 'UpdateType')->name('update.type');
    Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');

    /* Amenities Here */

    Route::get('/all/amenitie', 'AllAmenitie')->name('all.amenitie');
    Route::get('/add/amenitie', 'AddAmenitie')->name('add.amenitie');
    Route::post('/store/amenitie', 'StoreAmenitie')->name('store.amenitie');
    Route::get('/edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie');
    Route::post('/update/amenitie', 'UpdateAmenitie')->name('update.amenitie');
    Route::get('/delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie');

});

 // State  All Route
 Route::controller(StateController::class)->group(function(){

    Route::get('/all/state', 'AllState')->name('all.state');
    Route::get('/add/state', 'AddState')->name('add.state');
    Route::post('/store/state', 'StoreState')->name('store.state');
    Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
    Route::post('/update/state', 'UpdateState')->name('update.state');
    Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state');

});

 // State  All Route
 Route::controller(PropertyController::class)->group(function(){

    Route::get('/all/property', 'AllProperty')->name('all.property');
    Route::get('/add/property', 'AddProperty')->name('add.property');
    Route::post('/store/property', 'StoreProperty')->name('store.property');
    Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');

    Route::post('/update/property', 'UpdateProperty')->name('update.property');

    Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');



    Route::post('/update/facility', 'UpdateFacility')->name('update.property.facilities');


    Route::post('/update/image', 'UpdateImage')->name('update.image');

    Route::post('/update/multi/image', 'UpdateMultiImage')->name('update.multi.image');
/*
    Route::post('/update/each-multi-image/{id}', 'UpdateEachMultiImage')->name('update.each.multi.image'); */

    Route::get('/delete/each-multi-image/{id}', 'DeleteEachMultiImage')->name('delete.each.multi.image');

    Route::post('/store/new-multi-image/{id}', 'StoreNewMultiImage')->name('new.multi.image');

    /* Status Of Property */
    Route::get('/status/property/{property_id}', 'StatusProperty')->name('status.property');

        /* Move To Thrash */
 Route::get('/property/thrash/{pid}','moveToThrash')->name('property.thrash');

    /* view Thrash Data */
    Route::get('/property/thrash-data','RecycleBin')->name('property.thrash.data');

    /* Restore Trashed Data */
    Route::get('/property/restore-data/{pid}','RestoreProperty')->name('restore.property');

    Route::get('/property/delete-permanently/{id}', 'DeletePermanently')->name('property.deleteParmanently');

    /* Show Property */
    Route::get('/property/show-property/{pid}', 'ShowPropertyDetails')->name('property.show');

});




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

Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');

/* Redirect To Dashboard after Login  End */
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);


/* Agent Management By Admin Here */
/* Agent Middleware Route Here */
/* Route::middleware(['auth','role:agent'])->group(function(){
Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
}); */
