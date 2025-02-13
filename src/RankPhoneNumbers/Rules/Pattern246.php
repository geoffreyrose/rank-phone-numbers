<?php

namespace RankPhoneNumbers\Rules;

class Pattern246 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d246|246\d/';
        $this->points = 60;
        $this->name = 'pattern_246';
    }
}
