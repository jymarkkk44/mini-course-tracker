<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Topic;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::factory(3)->create()->each(function ($course) {
            Topic::factory(5)->create([
                'course_id' => $course->id,
                'status' => ['not_started', 'in_progress', 'done'][rand(0, 2)],
                'time_spent' => rand(10, 120),
            ]);
        });
    }
}

