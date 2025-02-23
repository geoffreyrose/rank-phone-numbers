<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Pattern357 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d357|357\d/';
        $this->points = 60;
        $this->name = 'pattern_357';
    }
}
