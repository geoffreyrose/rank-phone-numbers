<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Pattern369 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d369|369\d/';
        $this->points = 60;
        $this->name = 'pattern_369';
    }
}
