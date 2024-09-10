<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    
    // index metodu, tüm görevleri listeler
    public function index()
    {
        $tasks = Task::all();
        return view('index', compact('tasks'));
    }

    
    // store metodu, yeni görev ekler
    public function store(Request $request)
    {
        // Doğrulama
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        // Yeni task kaydetme
        Task::create([
            'task' => $request->task,
            'status' => 0, // Yeni eklenen görevler devam ediyor olarak başlar
        ]);

        return redirect()->back()->with('success', 'Görev başarıyla eklendi!');
    }

    
    // edit metodu, görevi düzenleme sayfasını gösterir
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    
    // update metodu, görevin durumunu günceller
    public function update(Request $request, string $id)
    {
        // Veritabanındaki görevi bul
        $task = Task::findOrFail($id);

        // Status değerini checkbox'ın durumuna göre güncelle
        $task->update([
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Görev başarıyla güncellendi!');
    }

    // updateTaskContent metodu, görevin içeriğini günceller
    public function updateTaskContent(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'task' => $request->task,
            // Status'u değiştirmiyoruz
        ]);

        return redirect()->route('tasks.index')->with('success', 'Görev başarıyla güncellendi!');
    }


    
    // destroy metodu, görevi siler
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->back()->with('success', 'Görev başarıyla silindi!');
    }
}
