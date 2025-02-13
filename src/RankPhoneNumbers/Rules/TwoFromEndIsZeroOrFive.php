<?php

namespace RankPhoneNumbers\Rules;

class TwoFromEndIsZeroOrFive extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d*[0 5]\d{2}$/';
        $this->points = 50;
        $this->name = 'two_from_end_is_zero_or_five';
    }
}
