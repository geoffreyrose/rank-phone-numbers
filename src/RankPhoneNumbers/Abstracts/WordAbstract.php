<?php

namespace RankPhoneNumbers\Abstracts;

abstract class WordAbstract
{
    public string $name {
        set => $this->name = $value;
        get => $this->name;
    }

    public int $points {
        set => $this->points = $value;
        get => $this->points;
    }

    public int $endingDigitsToCheck {
        set => $this->endingDigitsToCheck = $value;
        get => $this->endingDigitsToCheck;
    }

    public bool $isActive {
        set => $this->isActive = $value;
        get => $this->isActive;
    }
}
