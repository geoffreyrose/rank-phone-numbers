<?php

namespace RankPhoneNumbers\Rules;

class PatternTwoIncrement extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/(1357|2468|3579|4680|9753|8642|7531|6420)/';
        $this->points = 60;
        $this->name = 'pattern_two_increment';
    }
}
