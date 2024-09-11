<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// get ile TaskController içindeki index metodunu çağırır
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// post ile TaskController içindeki store metodunu çağırır ve görev eklemek için yönlendirir
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// put ile TaskController içindeki update metodunu çağırır ve görev durumunu düzenlemek için yönlendirir
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

// delete ile TaskController içindeki destroy metodunu çağırır ve görevi silmek için yönlendirir
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// put ile TaskController içindeki updateTaskContent metodunu çağırır ve görevi düzenlemek için yönlendirir
Route::put('/tasks/update-content/{id}', [TaskController::class, 'updateTaskContent'])->name('tasks.updateContent');

// bu komut ile tüm route'lar otomatik oluşturulur
Route::resource('tasks', TaskController::class); 