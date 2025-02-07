<?php

namespace RankPhoneNumbers;

use stdClass;

class RankPhoneNumbers
{
    public array $phoneNumbers = [];

    public ?string $phoneNumbersKeyName = null;

    private array $words;

    public function __construct()
    {
        $this->words = json_decode(file_get_contents(__DIR__ . '/words.json'), true);
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

    public function rank(): array
    {
        $rankedPhoneNumbers = [];
        $checks = [
            'repeats_in_a_row' => [
                'pattern' => '/\b(\d+)\1+\b/', // 11XX X11X XX11
                'points' => 100,
            ],
            'symmetrical' => [
                'pattern' => '/(\d)(\d)\2\1/', // 5225
                'points' => 100,
            ],
            'double_match' => [
                'pattern' => '/(\d)(\d)\1\2$/', // 2323
                'points' => 100,
            ],
            'sequential_numbers' => [
                'pattern' => '/(0123|1234|2345|3456|4567|5678|6789|7890|9876|8765|7654|6543|5432|4321|3210)/',
                'points' => 100,
            ],
            'partial_sequential_numbers' => [
                'pattern' => '/((\d)123|123(\d)|(\d)234|234(\d)|(\d)345|345(\d)|(\d)456|456(\d)|(\d)567|567(\d)|(\d)678|678(\d)|(\d)789|789(\d)|(\d)890|890(\d)|(\d)987|987(\d)|(\d)876|876(\d)|(\d)765|765(\d)|(\d)654|654(\d)|(\d)543|543(\d)|(\d)432|432(\d)|(\d)321|321(\d)|(\d)210|210(\d))/',
                'points' => 90,
            ],
            'one_three_or_two_four' => [
                'pattern' => '/(\d).\1|\d(\d).\2$/', // 1X1X X2X2
                'points' => 90,
            ],
            'one_is_zero' => [
                'pattern' => '/0\d{3}/', // 0XXX
                'points' => 25,
            ],
            'two_is_zero_or_five' => [
                'pattern' => '/\d{2}[0 5]\d/', // XX0X XX5X
                'points' => 50,
            ],
            'three_is_zero' => [
                'pattern' => '/\d{3}0\d/', // XXX0
                'points' => 45,
            ],
            'four_is_zero_or_five' => [
                'pattern' => '/\d{3}[0 5]/', // XXX0 XXX5
                'points' => 50,
            ],
            'same_numbers' => [
                'pattern' => '/(\d).*\1/', // 2XX2, 2X2X 22XX, 22X2, 222X, etc
                'points' => 60,
            ],
            'funny_69' => [
                'pattern' => '/\d{2}69/',
                'points' => 10,
            ],
            'funny_420' => [
                'pattern' => '/\d420/',
                'points' => 10,
            ],
            'song_5309' => [
                'pattern' => '/5309/', // https://en.wikipedia.org/wiki/867-5309/Jenny
                'points' => 100,
            ],
            'song_865' => [
                'pattern' => '/865\d|\d865/', // https://en.wikipedia.org/wiki/865_(song)
                'points' => 10,
            ],
            'pattern_x2_y2' => [
                'pattern' => '/(1200|1212|1224|1236|1248|2400|2412|2424|2436|2448|3600|3612|3624|3636|3648|4800|4812|4824|4836|4848)/', // patten X(X*2)Y(Y*2)
                'points' => 50,
            ],
            'pattern_135' => [
                'pattern' => '/\d135|135\d/',
                'points' => 60,
            ],
            'pattern_246' => [
                'pattern' => '/\d246|246\d/',
                'points' => 60,
            ],
            'pattern_357' => [
                'pattern' => '/\d357|357\d/',
                'points' => 60,
            ],
            'pattern_468' => [
                'pattern' => '/\d468|468\d/',
                'points' => 60,
            ],
            'pattern_579' => [
                'pattern' => '/\d579|579\d/',
                'points' => 60,
            ],
            'pattern_975' => [
                'pattern' => '/\d975|975\d/',
                'points' => 60,
            ],
            'pattern_864' => [
                'pattern' => '/\d864|864\d/',
                'points' => 60,
            ],
            'pattern_753' => [
                'pattern' => '/\d753|753\d/',
                'points' => 60,
            ],
            'pattern_642' => [
                'pattern' => '/\d642|642\d/',
                'points' => 60,
            ],
            'pattern_369' => [
                'pattern' => '/\d369|369\d/',
                'points' => 60,
            ],
            'pattern_963' => [
                'pattern' => '/\d963|963\d/',
                'points' => 60,
            ],
            'pattern_two_change' => [
                'pattern' => '/(1357|2468|3579|4680|9753|8642|7531|6420)/',
                'points' => 60,
            ],
        ];

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

            foreach ($checks as $check) {
                if (preg_match($check['pattern'], $number)) {
                    $rankedPhoneNumber->rank_phone_number_points += $check['points'];
                }
            }

            $wordMatch = [];
            foreach ([$lastFour, $lastFive, $lastSix, $lastSeven] as $substring) {
                $matches = array_keys($this->words, $substring, true);
                if (count($matches) > 0) {
                    $rankedPhoneNumber->rank_phone_number_points += 50;
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
