<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class Pattern753 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d753|753\d/';
        $this->points = 60;
        $this->name = 'pattern_753';
    }
}
