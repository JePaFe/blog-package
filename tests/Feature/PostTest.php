<?php

namespace JePaFe\Blog\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use JePaFe\Blog\Models\Post;
use Faker\Factory as Faker;
use JePaFe\Blog\Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_created()
    {
        $faker = Faker::create();

        $response = $this->post('/admin/posts', [
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
        ]);

        $this->assertCount(1, Post::all());

        $response->assertRedirect(Post::first()->path());
    }

    /** @test */
    public function a_title_is_required()
    {
        $faker = Faker::create();

        $response = $this->post('/admin/posts', [
            'body' => $faker->paragraph,
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_body_is_required()
    {
        $faker = Faker::create();

        $response = $this->post('/admin/posts', [
            'title' => $faker->sentence,
        ]);

        $response->assertSessionHasErrors('body');
    }

    /** @test */
    public function the_slug_must_be_unique()
    {
        $faker = Faker::create();
        $title = 'The title';
        $body = $faker->paragraph;

        $this->post('/admin/posts', [
            'title' => $title,
            'body' => $body,
        ]);

        $response = $this->post('/admin/posts', [
            'title' => $title,
            'body' => $body,
        ]);

        $response->assertSessionHasErrors('slug');
    }

    /** @test */
    public function a_post_can_be_shown()
    {
        $faker = Faker::create();
        $title = $faker->sentence;

        $this->post('/admin/posts', [
            'title' => $title,
            'body' => $faker->paragraph,
        ]);

        $post = Post::first();

        $this->get('/admin/posts/' . $post->slug);

        $this->assertEquals(Str::slug($title), $post->slug);
    }

    /** @test */
    public function a_post_can_be_updated()
    {
        $faker = Faker::create();

        $this->post('/admin/posts', [
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
        ]);

        $post = Post::first();

        $title = $faker->sentence;
        $body = $faker->paragraph;

        $response = $this->patch('/admin/posts/' . $post->slug, [
            'title' => $title,
            'body' => $body,
        ]);

        $post = Post::first();

        $this->assertEquals($title, $post->title);
        $this->assertEquals($body, $post->body);

        $response->assertRedirect($post->fresh()->path());
    }

    /** @test */
    public function a_post_can_be_deleted()
    {
        $faker = Faker::create();

        $this->post('/admin/posts', [
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
        ]);

        $this->assertCount(1, Post::all());

        $response = $this->delete('/admin/posts/' . Post::first()->slug);

        $this->assertCount(0, Post::all());

        $response->assertRedirect('/admin/posts');
    }
}
