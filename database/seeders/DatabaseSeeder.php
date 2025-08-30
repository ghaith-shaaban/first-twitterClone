<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['admin'=>1]);

        $users=User::factory(10)->create();

        $users->each(function($user){
            Idea::factory(3)
                ->for($user)
                ->has(
                    Comment::factory(5)
                        ->state(function (array $attributes, Idea $idea) {

                            $randomUser = User::inRandomOrder()->first();

                            return [
                                'user_id' => $randomUser->id,
                            ];
                        })
                )
                ->create();
        });

    }
}
