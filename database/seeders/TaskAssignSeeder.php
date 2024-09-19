<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\TaskAssignment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskAssignment::create([
            'taskName'=>rand(0,1999),
            'description'=>Str::random(10),
            'is_complete'=>rand(0,1),
            'user_id'=>1,
            'task_id'=>1,
        ]);
    }
}
