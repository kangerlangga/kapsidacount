<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DetectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublikController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.public.coming');
});

// Route::get('/', [PublikController::class, 'home'])->name('home.publik');
// Route::get('/about', [PublikController::class, 'about'])->name('about.publik');
// Route::get('/contact', [PublikController::class, 'contact'])->name('contact.publik');
// Route::post('/contact/send', [MessageController::class, 'store'])->name('contact.send');

// Rute Admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dash');
    Route::get('/admin/profile/edit', [AdminController::class, 'editProf'])->name('prof.edit');
    Route::post('/admin/profile/updateProfile', [AdminController::class, 'updateProf'])->name('prof.update');
    Route::get('/admin/profile/editPass', [AdminController::class, 'editPass'])->name('prof.edit.pass');
    Route::post('/admin/profile/updatePass', [AdminController::class, 'updatePass'])->name('prof.update.pass');

    Route::get('/admin/detect', [DetectionController::class, 'index'])->name('detect.data');
    Route::get('/admin/detect/add', [DetectionController::class, 'create'])->name('detect.add');
    Route::post('/admin/detect/store', [DetectionController::class, 'store'])->name('detect.store');
    Route::get('/admin/detect/edit/{id}', [DetectionController::class, 'edit'])->name('detect.edit');
    Route::post('/admin/detect/update/{id}', [DetectionController::class, 'update'])->name('detect.update');
    Route::get('/admin/detect/delete/{id}', [DetectionController::class, 'destroy'])->name('detect.delete');

    Route::get('/admin/detect/datakurang', [DetectionController::class, 'getDetections'])->name('kekurangan.data');
    Route::get('/admin/detect/datasemua', [DetectionController::class, 'getSummaryData'])->name('pengukuran.data');

    Route::get('/admin/user', [UserController::class, 'index'])->name('user.data');
    Route::get('/admin/user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/admin/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/admin/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/admin/user/resetPass/{id}', [UserController::class, 'resetPass'])->name('user.resetpass');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
