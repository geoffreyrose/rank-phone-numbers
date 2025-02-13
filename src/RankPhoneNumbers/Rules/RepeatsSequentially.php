<?php

namespace RankPhoneNumbers\Rules;

class RepeatsSequentially extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\b(\d+)\1+[0-9]*\b/'; // 11XX X11X XX11
        $this->points = 100;
        $this->name = 'repeats_in_a_row';
    }
}
