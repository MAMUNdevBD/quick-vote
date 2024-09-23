<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poll;
use App\Models\Option;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polls = Poll::factory()->count(5)->create();
        foreach ($polls as $poll) {
            Option::factory()->create([
                'poll_id' => $poll->id,
                'name' => 'yes',
            ]);
            Option::factory()->create([
                'poll_id' => $poll->id,
                'name' => 'no',
            ]);
        }
    }
}




