<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\PullRequest;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()
            ->has(PullRequest::factory()->count(3))
            ->count(50)
            ->create();
    }
}
