<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Song865 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/865\d|\d865/'; // https://en.wikipedia.org/wiki/865_(song)
        $this->points = 10;
        $this->name = 'song_865';
    }
}
