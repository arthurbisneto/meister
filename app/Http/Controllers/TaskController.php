<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the current day is a weekday
        $currentDay = Carbon::now()->dayOfWeek; // 0 (Sunday) through 6 (Saturday)
        if ($currentDay == Carbon::SATURDAY || $currentDay == Carbon::SUNDAY) {
            return redirect()->back()->withErrors('Tasks can only be created during weekdays.');
        }


        $request->validate([
            'title' => 'required',
            'datecreated' => 'required|date',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in progress,completed',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'datecreated' => 'required|date',
            'status' => 'required|in:pending,in progress,completed',
        ]);

         // Check if the status is 'pending'
        if ($task->status !== 'pending') {
            return redirect()->back()->withErrors('Tasks can only be updated if they are in "pending" status.');
        }


        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
    
        // Check if the task is older than 5 days
        $creationDate = Carbon::parse($task->created_at);
        $fiveDaysAgo = Carbon::now()->subDays(5);
    
        if ($creationDate > $fiveDaysAgo) {
            return redirect()->back()->withErrors('Tasks can only be deleted if they are older than 5 days.');
        }
    
        $task->delete();
    
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
    
}
