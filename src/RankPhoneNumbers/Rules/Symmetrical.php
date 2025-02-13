<?php

namespace RankPhoneNumbers\Rules;

class Symmetrical extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/(\d)(\d)\2\1/'; // 5225
        $this->points = 100;
        $this->name = 'symmetrical';
    }
}
