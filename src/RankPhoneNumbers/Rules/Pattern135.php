<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Pattern135 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d135|135\d/';
        $this->points = 60;
        $this->name = 'pattern_135';
    }
}
