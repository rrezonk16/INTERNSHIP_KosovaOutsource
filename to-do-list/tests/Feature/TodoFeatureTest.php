<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Todo;

class TodoFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_todo_list()
    {
        Todo::factory()->create([
            'title' => 'Test Todo',
            'description' => 'This is a test description'
        ]);

        $response = $this->get('/todos');

        $response->assertStatus(200);
        $response->assertSee('Test Todo');
    }

    public function test_todo_creation()
    {
        $response = $this->post('/todos', [
            'title' => 'New Todo',
            'description' => 'New Todo Description',
            'completed' => false,  
        ]);
    
        $response->assertStatus(302);
        $this->assertDatabaseHas('todos', ['title' => 'New Todo']);
    }
    

    public function test_todo_deletion()
    {
        $todo = Todo::factory()->create();

        $response = $this->delete('/todos/' . $todo->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
