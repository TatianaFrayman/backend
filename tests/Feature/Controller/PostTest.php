<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Exceptions\UrlGenerationException;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_index_success()
    {
        $response = $this->getJson(
            route("posts.index",
                [
                    "param" => "value"
                ])
        );

        $response
            ->dump()
            ->assertStatus(200);
    }

    public function test_index_failure()
    {
        $response = $this->getJson(
            route("posts.index",
                [
                    "error" => "this is error"
                ])
        );

        $response
            ->dump()
            ->assertStatus(400);
    }

    public function test_show_success()
    {
        $response = $this->getJson(
            route("posts.show",
                [
                    "post" => 2
                ])
        );

        $response
            ->dump()
            ->assertStatus(200);
    }

    public function test_show_failure()
    {
        try {
            $response = $this->getJson(
                route("posts.show")
            );
        } catch (UrlGenerationException $exception) {
            $this->assertIsString($exception->getMessage());
        }

    }

    public function test_store_success()
    {
        $response = $this->postJson(
            route("posts.store",
                [
                    "title" => "hello, buddy",
                    "text" => "this is my first post"
                ])
        );

        $response
            ->dump()
            ->assertCreated();
    }

    public function test_store_failure()
    {
        $response = $this->postJson(
            route("posts.store")
        );

        $response
            ->dump()
            ->assertStatus(400);
    }

    public function test_update_success()
    {
        $response = $this->putJson(
            route("posts.update",
                [
                    "post" => 1
                ])
        );

        $response
            ->dump()
            ->assertStatus(200);
    }

    public function test_update_failure()
    {
        try {
            $response = $this->putJson(
                route("posts.update")
            );
        } catch (UrlGenerationException $exception) {
            $this->assertIsString($exception->getMessage());
        }
    }

    public function test_destroy_success()
    {
        $response = $this->deleteJson(
            route("posts.destroy",
                [
                    "post" => 1
                ])
        );

        $response
            ->dump()
            ->assertStatus(200);
    }

    public function test_destroy_failure()
    {
        try {
            $response = $this->deleteJson(
                route("posts.destroy")
            );
        } catch (UrlGenerationException $exception) {
            $this->assertIsString($exception->getMessage());
        }
    }
}
