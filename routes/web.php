<?php

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TukangController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CekKaryawan;
use App\Models\SubTask;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class,'login']);
Route::get('/login', [UserController::class,'login']);
Route::post('/auth', [UserController::class,'auth']);

Route::get('/terima-proyek/{proyek}/{tukang}', [TukangController::class, 'terimaProyek'])
    ->name('proyek.terima')
    ->middleware('signed');
// Route::middleware(['role:tukangs'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboardView']);
// });
// Route::middleware(['auth:tukangs'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboardView'])->name('dashboard.tukang');
// });

// Route::middleware(['auth:karyawans'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboardView'])->name('dashboard.karyawan');
// });

// Route::middleware(['auth:kliens'])->group(function () {
    //     Route::get('/dashboard', [UserController::class, 'dashboardView'])->name('dashboard.klien');
    // });
    Route::middleware([CekKaryawan::class])->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboardView'])->name('dashboard');
        Route::get('/logout', [UserController::class, 'logout']);
        // untuk karyawan yang superadmin
        Route::get('/dashboard/create-karyawan', [KaryawanController::class, 'create']);
        Route::post('/store-karyawan', [KaryawanController::class, 'store']);

        // project
        Route::get('/dashboard/proyek/overview/{proyek}', [UserController::class, 'ProyekShow']);
        Route::delete('/proyek/delete/{proyek}', [ProyekController::class, 'delete']);
        Route::put('/proyek/update/{proyek}', [ProyekController::class, 'update']);
        Route::get('/dashboard/proyek/overview/', [ProyekController::class, 'index']);
        Route::get('/dashboard/proyek/task/{proyek}', [UserController::class,'TaskShow']);
        Route::put('/task/update/{task}', [TaskController::class,'update']);
        Route::delete('/task/delete/{task}', [TaskController::class,'delete']);
        Route::get('/dashboard/proyek/create',[ProyekController::class,'createView']);
        Route::get('/dashboard/proyek/detail/{project}',[ProyekController::class,'show']);
        Route::post('/create-task', [TaskController::class, 'create']);
        // task kanban
        Route::get('/dashboard/task', [UserController::class,'TaskKanbanView']);
        Route::get('/dashboard/task/proyek/{proyek}', [UserController::class,'TaskKanbanShow']);
        Route::get('/dashboard/proyek/task/', [UserController::class,'TaskIndex']);
        // handover project
        Route::get('/dashboard/handover/', [ProyekController::class, 'handOverIndex']);
        Route::get('/dashboard/handover/proyek/{proyek}', [ProyekController::class, 'handOverShow']);
        
        // test project
        Route::get('/dashboard/testing', [ProyekController::class, 'testProyek']);
        Route::get('/dashboard/testing/proyek/{proyek}', [ProyekController::class, 'testProyekShow']);
        
        // inbox
        Route::get('/dashboard/chats/proyek/{proyek}', [ProyekController::class, 'getObrolansByProyek']);
        Route::get('/dashboard/chats/', [ProyekController::class, 'obrolanIndex']);

        Route::post('/store-chat', [ProyekController::class, 'storeChat']);
        

        Route::post('/create-subtask', [SubTaskController::class, 'create']);
        Route::post('/create-proyek', [ProyekController::class, 'store']);
        Route::post('/assign-tukang', [SubTaskController::class, 'assignTukang']);
        Route::post('/check-testing', [ProyekController::class, 'CheckQuality']);
        Route::post('/subtask/update-status',[SubTaskController::class,'updateStatus']);
        Route::post('/proyek-confirmation',[ProyekController::class,'confirmationProyeks']);
    });
// Route::middleware(['role:karyawans'])->group(function () {
//     Route::get('/dashboard-karyawan', [UserController::class, 'dashboardView']);
// });
// Route::middleware(['role:kliens'])->group(function () {
//     Route::get('/dashboard-karyawan', [UserController::class, 'dashboardView']);
// });
// Route::middleware([''])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboardView']);
//     // Route::get('/dashboard/proyek/overview', [KaryawanController::class, 'index']);
//     Route::get('/dashboard/proyek/task', [TaskController::class, 'index']);
//     Route::post('/create-subtask', [SubTaskController::class, 'create']);
// });
Route::get('/register', function () {
    return view('welcome');
});




