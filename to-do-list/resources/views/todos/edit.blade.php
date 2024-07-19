<!-- resources/views/todos/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit To-Do')

@section('content')
    <h1>Edit To-Do</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $todo->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" id="description">{{ $todo->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="completed">Completed:</label>
            <select name="completed" id="completed" class="form-control">
                <option value="0" {{ !$todo->completed ? 'selected' : '' }}>No</option>
                <option value="1" {{ $todo->completed ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
