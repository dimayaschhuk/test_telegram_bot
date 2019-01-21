<?php


$botman = resolve('botman');

//$botman->hears('Hi', function ($bot) {
//    $bot->reply('Hello!');
//});
$botman->hears('{text}', 'App\Http\Controllers\AllBreedsController@hearText');


$botman->hears('/random', 'App\Http\Controllers\AllBreedsController@random');

$botman->hears('/b {breed}', 'App\Http\Controllers\AllBreedsController@byBreed');

$botman->hears('/s {breed}:{subBreed}', 'App\Http\Controllers\SubBreedController@random');

$botman->hears('Start conversation', 'App\Http\Controllers\ConversationController@index');

$botman->fallback('App\Http\Controllers\FallbackController@index');
