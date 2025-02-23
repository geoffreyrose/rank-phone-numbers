<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Pattern579 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d579|579\d/';
        $this->points = 60;
        $this->name = 'pattern_579';
    }
}
