<?php

namespace RankPhoneNumbers\Rules;

class SequentialNumbers extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/(0123|1234|2345|3456|4567|5678|6789|7890|9876|8765|7654|6543|5432|4321|3210)/';
        $this->points = 100;
        $this->name = 'sequential_numbers';
    }
}
