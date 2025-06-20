<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['not_started', 'in_progress', 'done'];

        foreach ($statuses as $name) {
            Status::create(['name' => $name]);
        }
    }
}
