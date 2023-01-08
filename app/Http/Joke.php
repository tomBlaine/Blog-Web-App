<?php

namespace App\Http;

class Joke
{

    public function __construct(){
        
    }

    public function getRandomJoke()
    {
        $response=file_get_contents("https://v2.jokeapi.dev/joke/Any?blacklistFlags=nsfw,religious,racist,sexist,explicit&format=txt&type=single");
        return $response;
    }

}