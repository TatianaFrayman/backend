<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_relation()
    {
        $test = $this;
        $count = random_int(1,4);

        $category = Category::factory()->create();
        $posts = Post::factory()->count($count)->create();
        $category->posts()->sync($posts);

        $this->assertTrue(
            $category->posts()->count() == $count
        );

        $category->posts->each(function (Post $post) use ($test) {
            $test->assertInstanceOf(
                Post::class,
                $post
            );
        });

    }
}

