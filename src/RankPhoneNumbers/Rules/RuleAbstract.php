<?php

namespace RankPhoneNumbers\Rules;

abstract class RuleAbstract
{
    public string $pattern {
        set => $this->pattern = $value;
        get => $this->pattern;
    }

    public int $points {
        set => $this->points = $value;
        get => $this->points;
    }

    public string $name {
        set => $this->name = $value;
        get => $this->name;
    }
}
