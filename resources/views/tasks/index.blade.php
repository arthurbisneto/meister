
@extends('layouts.app')

@section('content')
    <h2>Task List</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Date Created</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->datecreated }}</td>
            <td>{{ $task->status }}</td>
            <td>
                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">Show</a>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection

