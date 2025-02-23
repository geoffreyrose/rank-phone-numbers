<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class DoubleMatch extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/(\d)(\d)\1\2/'; // 2323
        $this->points = 100;
        $this->name = 'double_match';
    }
}
