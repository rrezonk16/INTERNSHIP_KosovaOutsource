<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_todo_list()
    {
        Todo::factory()->count(3)->create();

        $response = $this->get(route('todos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('todos.index');
        $response->assertViewHas('todos');
    }

    public function test_todo_creation()
    {
        $response = $this->post(route('todos.store'), [
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
        ]);

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseHas('todos', [
            'title' => 'Test Todo',
            'description' => 'Test Description',
            'completed' => false,
        ]);
    }

    public function test_todo_update()
    {
        $todo = Todo::factory()->create();

        $response = $this->put(route('todos.update', $todo), [
            'title' => 'Updated Todo',
            'description' => 'Updated Description',
            'completed' => true,
        ]);

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => 'Updated Todo',
            'description' => 'Updated Description',
            'completed' => true,
        ]);
    }

    public function test_todo_deletion()
    {
        $todo = Todo::factory()->create();

        $response = $this->delete(route('todos.destroy', $todo));

        $response->assertRedirect(route('todos.index'));
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }
}
