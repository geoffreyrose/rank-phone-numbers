<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Pattern975 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d975|975\d/';
        $this->points = 60;
        $this->name = 'pattern_975';
    }
}
