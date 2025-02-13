<?php

namespace RankPhoneNumbers\Rules;

class SameNumbers extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/(\d).*\1/'; // 2XX2, 2X2X 22XX, 22X2, 222X, etc
        $this->points = 75;
        $this->name = 'same_numbers';
    }
}
