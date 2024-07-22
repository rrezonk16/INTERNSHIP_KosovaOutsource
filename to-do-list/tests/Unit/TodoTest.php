<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_todo_creation()
    {
        $todo = Todo::create([
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
        ]);

        $this->assertDatabaseHas('todos', [
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
        ]);
    }

    public function test_todo_update()
    {
        $todo = Todo::create([
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
        ]);

        $todo->update([
            'title' => 'Updated Todo',
            'description' => 'Updated Description',
            'completed' => true,
        ]);

        $this->assertDatabaseHas('todos', [
            'title' => 'Updated Todo',
            'description' => 'Updated Description',
            'completed' => true,
        ]);
    }

    public function test_todo_deletion()
    {
        $todo = Todo::create([
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
        ]);

        $todo->delete();

        $this->assertDatabaseMissing('todos', [
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
        ]);
    }
}
