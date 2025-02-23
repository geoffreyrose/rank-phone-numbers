<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class EndsInZeroOrFive extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/\d{3}[0 5]/'; // XXX0 XXX5
        $this->points = 50;
        $this->name = 'ends_in_zero_or_five';
    }
}
