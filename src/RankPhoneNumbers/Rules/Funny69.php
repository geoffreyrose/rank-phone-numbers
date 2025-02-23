<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Funny69 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d{2}69/';
        $this->points = 10;
        $this->name = 'funny_69';
    }
}
