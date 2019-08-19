<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use JePaFe\Blog\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    $body = $faker->paragraph;
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $body,
    ];
});
