<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Pattern468 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d468|468\d/';
        $this->points = 60;
        $this->name = 'pattern_468';
    }
}
