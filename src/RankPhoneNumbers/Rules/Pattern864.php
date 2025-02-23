<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Pattern864 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d864|864\d/';
        $this->points = 60;
        $this->name = 'pattern_864';
    }
}
