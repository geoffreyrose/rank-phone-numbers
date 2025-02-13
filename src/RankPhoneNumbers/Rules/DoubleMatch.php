<?php

namespace RankPhoneNumbers\Rules;

class DoubleMatch extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/(\d)(\d)\1\2/'; // 2323
        $this->points = 100;
        $this->name = 'double_match';
    }
}
