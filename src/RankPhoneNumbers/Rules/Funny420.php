<?php

namespace RankPhoneNumbers\Rules;

class Funny420 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d420/';
        $this->points = 10;
        $this->name = 'funny_420';
    }
}
