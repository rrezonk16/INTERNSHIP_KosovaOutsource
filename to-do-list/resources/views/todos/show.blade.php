<!-- resources/views/todos/show.blade.php -->

@extends('layouts.app')

@section('title', 'Show To-Do')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@section('content')
    <h1>To-Do Details</h1>

    <div>
        <strong>Title:</strong>
        {{ $todo->title }}
    </div>
    <div>
        <strong>Description:</strong>
        {{ $todo->description }}
    </div>
    <div>
        <strong>Completed:</strong>
        {{ $todo->completed ? 'Yes' : 'No' }}
    </div>

    <a href="{{ route('todos.index') }}" class="btn btn-primary">Back to List</a>
@endsection
