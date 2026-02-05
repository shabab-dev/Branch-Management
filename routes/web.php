<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin|branch-manager'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    //admin.logout
    Route::get('/admin/logout',[AdminController::class,'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class,'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password',[AdminController::class,'AdminUpdatePassword'])->name('admin.update.password');

});

Route::get('/admin/login',[AdminController::class,'AdminLogin'])->middleware(RedirectIfAuthenticated::class)->name('admin.login');
Route::get('/admin/logout/page',[AdminController::class,'AdminLogoutPage'])->name('admin.logout.page');

//All Branch related route
Route::middleware(['auth','role:admin|branch-manager'])->group(function(){
    // Branch
    Route::controller(BranchController::class)->group(function(){
        Route::get('/all/branch','AllBranch')->name('all.branch');
        Route::get('/add/branch','AddBranch')->name('add.branch');
        Route::post('/store/branch','StoreBranch')->name('store.branch');
        Route::get('/edit/branch/{id}','EditBranch')->name('edit.branch');
        Route::post('/update/branch','UpdateBranch')->name('update.branch');
        Route::get('/delete/branch/{id}','DeleteBranch')->name('delete.branch');
    });

    // BranchManager
    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/manager','AllManager')->name('all.manager');
        Route::get('/add/manager','AddManager')->name('add.manager');
        Route::post('/store/manager','StoreManager')->name('store.manager');
        Route::get('/edit/manager/{id}','EditManager')->name('edit.manager');
        Route::post('/update/manager','UpdateManager')->name('update.manager');
        Route::get('/delete/manager/{id}','DeleteManager')->name('delete.manager');
        Route::get('/inactive/manager/{id}','InactiveManager')->name('inactive.manager');
        Route::get('/active/manager/{id}','ActiveAManager')->name('active.manager');
    });

    // Branch
    Route::controller(EmployeeController::class)->group(function(){
        Route::get('/all/employees','AllEmployees')->name('all.employees');
        Route::get('/add/employee','AddEmployee')->name('add.employee');
        //Route::post('/store/branch','StoreBranch')->name('store.branch');
        //Route::get('/edit/branch/{id}','EditBranch')->name('edit.branch');
        //Route::post('/update/branch','UpdateBranch')->name('update.branch');
        //Route::get('/delete/branch/{id}','DeleteBranch')->name('delete.branch');
    });
});


