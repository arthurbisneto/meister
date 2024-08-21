<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use Carbon\Carbon;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testTasksCanOnlyBeCreatedOnWeekdays()
    {
        Carbon::setTestNow(Carbon::parse('2024-08-17')); // Saturday

        $response = $this->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'status' => 'pending',
        ]);

        $response->assertSessionHasErrors('Tasks can only be created during weekdays.');

        Carbon::setTestNow(null); // Reset to current time
    }

    public function testTasksCanOnlyBeUpdatedIfStatusIsPending()
    {
        $task = Task::factory()->create([
            'status' => 'completed',
        ]);

        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Updated Task Title',
            'description' => 'Updated description.',
            'status' => 'in progress',
        ]);

        $response->assertSessionHasErrors('Tasks can only be updated if they are in "pending" status.');

        // Update task to have a pending status
        $task->update(['status' => 'pending']);

        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Updated Task Title',
            'description' => 'Updated description.',
            'status' => 'in progress',
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task Title',
            'description' => 'Updated description.',
            'status' => 'in progress',
        ]);
    }

    public function testTasksCanOnlyBeDeletedIfOlderThanFiveDays()
    {
        // Task created 4 days ago
        Carbon::setTestNow(Carbon::now());

        $task = Task::factory()->create([
            'created_at' => Carbon::now()->subDays(4),
            'updated_at' => Carbon::now()->subDays(4),
        ]);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertSessionHasErrors('Tasks can only be deleted if they are older than 5 days.');

        Carbon::setTestNow(null); // Reset to current time

        // Make the task older than 5 days
        $task->update([
            'created_at' => Carbon::now()->subDays(6),
            'updated_at' => Carbon::now()->subDays(6),
        ]);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
