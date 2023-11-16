<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Category;

use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'product_name' => $faker->word,
        'product_description' => $faker->sentence,
        'product_price' => $faker->randomFloat(2, 10, 100),
        'product_cost' => $faker->randomFloat(2, 5, 50),
        'quantity' => $faker->numberBetween(0, 100),
        'unit_id' => function () {
            return factory(Unit::class)->create()->id;
        },
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'brand_id' => function () {
            return factory(Brand::class)->create()->id;
        },

    ];
});
