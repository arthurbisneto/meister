<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'datecreated' => 'required|date',
            'status' => 'required|in:pending,in progress,completed',
        ]);

        Task::create($request->all());
        return redirect()->route('index')->with('success', 'Task created successfully.');
  
    }
    public function show(Task $task)
    {
        return view('show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'datecreated' => 'required|date',
            'status' => 'required|in:pending,in progress,completed',
        ]);

        $task->update($request->all());
        return redirect()->route('index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('index')->with('success', 'Task deleted successfully.');
    }
}
