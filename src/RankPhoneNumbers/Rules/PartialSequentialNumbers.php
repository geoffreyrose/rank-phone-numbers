<?php

namespace RankPhoneNumbers\Rules;

class PartialSequentialNumbers extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/((\d)123|123(\d)|(\d)234|234(\d)|(\d)345|345(\d)|(\d)456|456(\d)|(\d)567|567(\d)|(\d)678|678(\d)|(\d)789|789(\d)|(\d)890|890(\d)|(\d)987|987(\d)|(\d)876|876(\d)|(\d)765|765(\d)|(\d)654|654(\d)|(\d)543|543(\d)|(\d)432|432(\d)|(\d)321|321(\d)|(\d)210|210(\d))/';
        $this->points = 90;
        $this->name = 'partial_sequential_numbers';
    }
}
