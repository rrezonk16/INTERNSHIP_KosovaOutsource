<!-- resources/views/todos/index.blade.php -->

@extends('layouts.app')

@section('title', 'To-Do List')

@section('content')
    <h1>To-Do List</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="create-todo">
        <a href="{{ route('todos.create') }}" class="btn btn-primary">Create New Todo</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
                <tr class="{{ $todo->completed ? 'done-todo' : 'not-done' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ $todo->completed ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('todos.show', $todo->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
