<?php

namespace RankPhoneNumbers\Rules;

class Song5309 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/5309/'; // https://en.wikipedia.org/wiki/867-5309/Jenny
        $this->points = 100;
        $this->name = 'song_5309';
    }
}
