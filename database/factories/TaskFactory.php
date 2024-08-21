<?php


namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => 'pending',
            'datecreated' => Carbon::now(), // Set default value for datecreated
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}