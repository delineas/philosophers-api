<?php

use Faker\Generator as Faker;

$factory->define(App\Vote::class, function (Faker $faker) {
    // $voteables = [
    //     App\Quote::class,
    // ]; 
    // $voteableType = $faker->randomElement($voteables);
    // $voteable = factory($voteableType)->create();
    return [
        'type' => $faker->randomElement(['up', 'down']),
        'voteable_type' => App\Quote::class,
        'voteable_id' => function () {
            return App\Quote::first()->id;
        },
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
