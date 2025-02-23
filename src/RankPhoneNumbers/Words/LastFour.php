<?php

namespace RankPhoneNumbers\Words;

use RankPhoneNumbers\Abstracts\WordAbstract;

class LastFour extends WordAbstract
{
    public function __construct()
    {
        $this->points = 5;
        $this->isActive = true;
        $this->endingDigitsToCheck = 4;
        $this->name = 'word_is_last_four';
    }
}
