<?php

namespace RankPhoneNumbers\Words;

use RankPhoneNumbers\Abstracts\WordAbstract;

class LastFive extends WordAbstract
{
    public function __construct()
    {
        $this->points = 5;
        $this->isActive = true;
        $this->endingDigitsToCheck = 5;
        $this->name = 'word_is_last_five';
    }
}
