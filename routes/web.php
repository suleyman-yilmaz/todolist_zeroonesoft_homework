<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// get ile TaskController içindeki index metodunu çağırır
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// post ile TaskController içindeki store metodunu çağırır ve görev eklemek için yönlendirir
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// get ile TaskController içindeki edit metodunu çağırır ve görev durumunu düzenlemek için yönlendirir
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

// get ile TaskController içindeki edit metodunu çağırır ve görevi düzenlemek için yönlendirir
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// get ile TaskController içindeki edit metodunu çağırır ve görevi düzenlemek için yönlendirir
Route::put('/tasks/update-content/{id}', [TaskController::class, 'updateTaskContent'])->name('tasks.updateContent');

// bu komut ile tüm route'lar otomatik oluşturulur
Route::resource('tasks', TaskController::class); 