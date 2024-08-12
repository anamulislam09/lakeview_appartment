<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
|
*/

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\BasicInfoController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\AppartmentController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});

Route::view('/', 'admin.auth.login');
Route::prefix('admin')->namespace('App\Http\Controllers\admin')->group(function () {

    // Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);

    Route::post('login', [AdminController::class, 'login']);
    Route::middleware('admin')->group(function () {
        Route::post('logout', [AdminController::class, 'logout']);

        //------------building route ------------>
        Route::get('/building/all', [BuildingController::class, 'index'])->name('building.index');
        Route::get('/building/create', [BuildingController::class, 'create'])->name('building.create');
        Route::post('/building/store', [BuildingController::class, 'store'])->name('building.store');
        Route::get('/building/edit/{id}', [BuildingController::class, 'edit']);
        Route::post('/building/update', [BuildingController::class, 'update'])->name('building.update');
        Route::get('/building/delete/{id}', [BuildingController::class, 'destroy'])->name('building.destroy');

        //------------appartment route ------------>
        Route::get('/appartment/all', [AppartmentController::class, 'index'])->name('appartment.index');
        Route::get('/appartment/create', [AppartmentController::class, 'create'])->name('appartment.create');
        Route::post('/appartment/store', [AppartmentController::class, 'store'])->name('appartment.store');
        Route::get('/appartment/edit/{id}', [AppartmentController::class, 'edit'])->name('appartment.edit');
        Route::post('/appartment/update', [AppartmentController::class, 'update'])->name('appartment.update');
        Route::get('/appartment/delete/{id}', [AppartmentController::class, 'destroy'])->name('appartment.destroy');

        // Route::get('/get-floor/{building_id}', [AppartmentController::class, 'getFloor']);  // get appartment using ajax
        

        //------------members route ------------>
        Route::get('/member/all', [MemberController::class, 'index'])->name('member.index');
        Route::get('/member/show/{id}', [MemberController::class, 'show'])->name('member.show');
        Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
        Route::get('/get-appartments/{buildingId}', [MemberController::class, 'getAppartments']);
        Route::get('/get-floors/{buildingId}', [AppartmentController::class, 'getFloor']);
        Route::get('/get-appartment/{floorId}', [MemberController::class, 'getAppartment']);
        // Route::get('/get-apartment/{floorId}', [MemberController::class, 'getAppartments']);
        Route::get('/filter-members', [MemberController::class, 'filterMembers']);

        Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
        Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');
        Route::post('/member/update', [MemberController::class, 'update'])->name('member.update');
        Route::get('/member/delete/{id}', [MemberController::class, 'destroy'])->name('member.destroy');

        //------------appartment route ------------>
        Route::get('/family-member/all', [FamilyMemberController::class, 'index'])->name('family-member.index');
        Route::get('/family-member/create', [FamilyMemberController::class, 'create'])->name('family-member.create');
        Route::post('/family-member/store', [FamilyMemberController::class, 'store'])->name('family-member.store');
        Route::get('/family-member/edit/{id}', [FamilyMemberController::class, 'edit'])->name('family-member.edit');
        Route::post('/family-member/update', [FamilyMemberController::class, 'update'])->name('family-member.update');
        Route::get('/family-member/delete/{id}', [FamilyMemberController::class, 'destroy'])->name('family-member.destroy');

        Route::prefix('profile')->group(function () {
            Route::post('check-admin-password', [AdminController::class, 'checkAdminPassword']);
            Route::match(['get', 'post'], 'update-admin-details/{id?}', [AdminController::class, 'updateAdminDetails'])->name('admins.update.details');
            Route::match(['get', 'post'], 'update-admin-password/{id?}', [AdminController::class, 'updateAdminPassword'])->name('admins.update.password');
        });

        Route::resource('dashboard', DashboardController::class);
        Route::resource('basic-infos', BasicInfoController::class);
        Route::prefix('admin')->group(function () {
            Route::resource('roles', RoleController::class);
            Route::resource('admins', AdminController::class);
        });
    });
});

require __DIR__ . '/auth.php';
