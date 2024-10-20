<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class RandomCommentsSeeder extends Seeder
{
    public function run()
    {
        $users = User::inRandomOrder()->take(3)->get();

        $posts = Post::all();

        foreach ($users as $user) {

            $numberOfComments = rand(1, 5);

            for ($i = 0; $i < $numberOfComments; $i++) {

                Comment::factory()->create([
                    'user_id' => $user->id,
                    'post_id' => $posts->random()->id,
                ]);
            }
        }
    }
}
