@extends('layouts.app')

@section('content')
    <h2>Show Task</h2>

    <div class="card">
        <div class="card-header">
            {{ $task->title }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Date Created: {{ $task->datecreated }}</h5>
            <p class="card-text">{{ $task->description }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $task->status }}</p>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
