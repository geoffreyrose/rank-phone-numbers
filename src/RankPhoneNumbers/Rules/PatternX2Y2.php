<?php

namespace RankPhoneNumbers\Rules;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class PatternX2Y2 extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/(1200|1212|1224|1236|1248|2400|2412|2424|2436|2448|3600|3612|3624|3636|3648|4800|4812|4824|4836|4848)/'; // patten X(X*2)Y(Y*2)
        $this->points = 50;
        $this->name = 'pattern_x2y2';
    }
}
