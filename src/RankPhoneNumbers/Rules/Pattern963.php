<?php

namespace RankPhoneNumbers\Rules;

class Pattern963 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d963|963\d/';
        $this->points = 60;
        $this->name = 'pattern_963';
    }
}
