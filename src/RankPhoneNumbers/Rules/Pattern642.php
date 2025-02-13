<?php

namespace RankPhoneNumbers\Rules;

class Pattern642 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d642|642\d/';
        $this->points = 60;
        $this->name = 'pattern_642';
    }
}
