<?php

namespace RankPhoneNumbers\Rules;

class Pattern975 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d975|975\d/';
        $this->points = 60;
        $this->name = 'pattern_975';
    }
}
