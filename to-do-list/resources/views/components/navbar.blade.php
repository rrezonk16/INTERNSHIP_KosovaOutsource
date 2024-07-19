<!-- resources/views/components/navbar.blade.php -->

<nav class="navbar">
    <div class="container">
        <a href="{{ route('todos.index') }}" class="navbar-brand">To-Do List</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('todos.index') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('todos.create') }}" class="nav-link">Create New Todo</a>
            </li>
        </ul>
    </div>
</nav>
