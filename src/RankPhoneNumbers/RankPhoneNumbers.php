<?php

namespace RankPhoneNumbers;

use stdClass;

class RankPhoneNumbers
{
    public array $phoneNumbers = [];

    public ?string $phoneNumbersKeyName = null;

    private array $words;

    public array $rules = [];

    public function __construct()
    {
        $this->words = json_decode(file_get_contents(__DIR__ . '/words.json'), true);

        $this->addRule(new \RankPhoneNumbers\Rules\DoubleMatch);
        $this->addRule(new \RankPhoneNumbers\Rules\EndsInZeroOrFive);
        $this->addRule(new \RankPhoneNumbers\Rules\Funny69);
        $this->addRule(new \RankPhoneNumbers\Rules\Funny420);
        $this->addRule(new \RankPhoneNumbers\Rules\PartialSequentialNumbers);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern135);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern246);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern357);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern369);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern468);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern579);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern642);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern753);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern864);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern963);
        $this->addRule(new \RankPhoneNumbers\Rules\Pattern975);
        $this->addRule(new \RankPhoneNumbers\Rules\PatternTwoIncrement);
        $this->addRule(new \RankPhoneNumbers\Rules\PatternX2Y2);
        $this->addRule(new \RankPhoneNumbers\Rules\RepeatsSequentially);
        $this->addRule(new \RankPhoneNumbers\Rules\SameNumbers);
        $this->addRule(new \RankPhoneNumbers\Rules\SequentialNumbers);
        $this->addRule(new \RankPhoneNumbers\Rules\Song865);
        $this->addRule(new \RankPhoneNumbers\Rules\Song5309);
        $this->addRule(new \RankPhoneNumbers\Rules\Symmetrical);
        $this->addRule(new \RankPhoneNumbers\Rules\TwoFromEndIsZeroOrFive);
    }

    public function setPhoneNumbers(array $phoneNumbers): self
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }

    public function setPhoneNumbersKeyName(string $phoneNumbersKeyName): self
    {
        $this->phoneNumbersKeyName = $phoneNumbersKeyName;

        return $this;
    }

    public function addRule($rule): self
    {
        if (get_parent_class($rule) !== \RankPhoneNumbers\Rules\RuleAbstract::class) {
            throw new \Exception('Rule must extend \RankPhoneNumbers\Rules\RuleAbstract');
        }

        $new = new $rule;
        $this->rules[$new->name] = $new;

        return $this;
    }

    public function rank(): array
    {
        $rankedPhoneNumbers = [];

        foreach ($this->phoneNumbers as $phoneNumber) {
            $number = $phoneNumber;
            if ($this->phoneNumbersKeyName) {
                if (is_array($phoneNumber)) {
                    $number = $phoneNumber[$this->phoneNumbersKeyName];
                } elseif (is_object($phoneNumber)) {
                    $number = $phoneNumber->{$this->phoneNumbersKeyName};
                }
            }

            $rankedPhoneNumber = new stdClass;
            $rankedPhoneNumber->number = $number;
            $rankedPhoneNumber->rank_phone_number_points = 0;

            $number = preg_filter('/\D/', '', $number);
            $lastFour = substr($number, -4);
            $lastFive = substr($number, -5);
            $lastSix = substr($number, -6);
            $lastSeven = substr($number, -7);

            foreach ($this->rules as $rule) {
                if (preg_match($rule->pattern, $lastFour)) {
                    $rankedPhoneNumber->rank_phone_number_points += $rule->points;
                }
            }

            $wordMatch = [];
            foreach ([$lastFour, $lastFive, $lastSix, $lastSeven] as $substring) {
                $matches = array_keys($this->words, $substring, true);
                if (count($matches) > 0) {
                    $rankedPhoneNumber->rank_phone_number_points += 5;
                    $wordMatch = array_merge($wordMatch, $matches);
                }
            }

            $rankedPhoneNumber->rank_phone_number_word_match_end = $wordMatch;

            if ($this->phoneNumbersKeyName) {
                if (is_array($phoneNumber)) {
                    $phoneNumber['rank_phone_number_points'] = $rankedPhoneNumber->rank_phone_number_points;
                    $phoneNumber['rank_phone_number_word_match_end'] = $rankedPhoneNumber->rank_phone_number_word_match_end;
                } elseif (is_object($phoneNumber)) {
                    $phoneNumber->rank_phone_number_points = $rankedPhoneNumber->rank_phone_number_points;
                    $phoneNumber->rank_phone_number_word_match_end = $rankedPhoneNumber->rank_phone_number_word_match_end;
                } else {
                    $newData['number'] = $phoneNumber;
                    $newData['rank_phone_number_points'] = $rankedPhoneNumber->rank_phone_number_points;
                    $newData['rank_phone_number_word_match_end'] = $rankedPhoneNumber->rank_phone_number_word_match_end;
                    $phoneNumber = (object) $newData;
                }
            } else {
                $newData['number'] = $phoneNumber;
                $newData['rank_phone_number_points'] = $rankedPhoneNumber->rank_phone_number_points;
                $newData['rank_phone_number_word_match_end'] = $rankedPhoneNumber->rank_phone_number_word_match_end;
                $phoneNumber = (object) $newData;
            }

            $rankedPhoneNumbers[] = $phoneNumber;
        }

        //        usort($rankedPhoneNumbers, function ($a, $b) {
        //            return $b->rank_phone_number_points <=> $a->rank_phone_number_points;
        //        });

        // seems to be very slightly faster than usort
        $points = array_column($rankedPhoneNumbers, 'rank_phone_number_points');
        array_multisort($points, SORT_DESC, $rankedPhoneNumbers);

        $this->phoneNumbers = $rankedPhoneNumbers;

        return $this->phoneNumbers;
    }
}
