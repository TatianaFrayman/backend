<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->count(10)
            ->create()
            ->each(function (User $user) {
            Post::factory()
                ->count(random_int(4,12))
                ->create([
                "user_id" => $user->id
            ])->each(function (Post $post) {
                $post->categories()->sync(
                    Category::inRandomOrder()
                        ->take(random_int(1,4))
                        ->get()
                        ->pluck("id")
                    );
                });
        });
    }
}
