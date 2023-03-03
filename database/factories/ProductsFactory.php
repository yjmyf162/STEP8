<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->word,
        'price' => $faker->numberBetween(100,200),
        'stock' => $faker->numberBetween(10,100)
    ];
});
