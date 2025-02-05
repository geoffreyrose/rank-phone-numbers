<?php

namespace RankPhoneNumbers;

class RankPhoneNumbers
{
    public array $phoneNumbers = [];
    public ?string $phoneNumbersKeyName = null;

    public function __construct()
    {
        // Constructor
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
        foreach ($this->phoneNumbers as $phoneNumber) {
            $number = $phoneNumber;
            if($this->phoneNumbersKeyName) {
                if(is_array($phoneNumber)) {
                    $number = $phoneNumber[$this->phoneNumbersKeyName];
                } elseif (is_object($phoneNumber)) {
                    $number = $phoneNumber->{$this->phoneNumbersKeyName};
                }
            }
            $rankedPhoneNumber['number'] = $number;
            $rankedPhoneNumber['__ranked_phone_number_points__'] = 0;

            preg_filter('/\D/', '', $number);
            $lastFour = substr($number, -4);

            // Repeated numbers in a row
            if(preg_match('/\b(\d+)\1+\b/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 100;
            }

            // Symmetrical/Mirrored (5225)
            if(preg_match('/(\d)(\d)\2\1/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 100;
            }

            // Double Match 2323
            if(preg_match('/(\d)(\d)\1\2$/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 100;
            }

            // Sequential numbers (1234) (4321)
            if(preg_match('/(0123|1234|2345|3456|4567|5678|6789|7890|9876|8765|7654|6543|5432|4321|3210)/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 100;
            }

            // partial sequential numbers ie (123X) (432X)
            if(preg_match('/((\d)123|123(\d)|(\d)234|234(\d)|(\d)345|345(\d)|(\d)456|456(\d)|(\d)567|567(\d)|(\d)678|678(\d)|(\d)789|789(\d)|(\d)890|890(\d)|(\d)987|987(\d)|(\d)876|876(\d)|(\d)765|765(\d)|(\d)654|654(\d)|(\d)543|543(\d)|(\d)432|432(\d)|(\d)321|321(\d)|(\d)210|210(\d))/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 90;
            }

            // 1 and 3 or 2 and 4 the same
            if(preg_match('/(\d).\1|\d(\d).\2$/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 90;
            }

            // 4 is 0 or 5
            if(preg_match('/\d{3}[0 5]/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 50;
            }

            // 2 is 0
            if(preg_match('/\d{1}[0]\d{2}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 50;
            }

            // 3 is 0
            if(preg_match('/\d{3}[0]\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 45;
            }

            // 1 is 0
            if(preg_match('/[0]\d{3}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 25;
            }

            // if contains same number more than once
            if(preg_match('/(\d).*\1/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            //* 5309 /song /
            if(preg_match('/5309/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 100;
            }

            //* XX69 /funny
            if(preg_match('/\d{2}69/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 10;
            }

            //* X420 /funny
            if(preg_match('/\d{1}420/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 10;
            }

            //* X865 /song
            if(preg_match('/\d{1}865/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 10;
            }

            //* 865X /song
            if(preg_match('/865\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 10;
            }

            // 1200, 1212, 1224, 1236, 1248, 2400, 2412, 2424, 2436, 2448, 3600, 3612, 3624, 3636, 3648, 4800, 4812, 4824, 4836, 4848
            // patten X(X*2)Y(Y*2)
            if(preg_match('/(1200|1212|1224|1236|1248|2400|2412|2424|2436|2448|3600|3612|3624|3636|3648|4800|4812|4824|4836|4848)/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 50;
            }

            // Patterns (X369)
            if(preg_match('/\d{1}369/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (369X)
            if(preg_match('/369\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (X246)
            if(preg_match('/\d{1}246/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (246X)
            if(preg_match('/246\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (X468)
            if(preg_match('/\d{1}468/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (468X)
            if(preg_match('/468\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (X135)
            if(preg_match('/\d{1}135/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (135X)
            if(preg_match('/135\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (X357)
            if(preg_match('/\d{1}357/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (357X)
            if(preg_match('/357\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (X579)
            if(preg_match('/\d{1}579/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (579X)
            if(preg_match('/579\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (X753)
            if(preg_match('/\d{1}753/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (753X)
            if(preg_match('/753\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (X864)
            if(preg_match('/\d{1}864/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (864X)
            if(preg_match('/864\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (X642)
            if(preg_match('/\d{1}642/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (642X)
            if(preg_match('/642\d{1}/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            // Patterns (1357) (2468) (3579) (4680) (9753) (8642) (7531) (6420)
            if(preg_match('/(1357|2468|3579|4680|9753|8642|7531|6420)/', $lastFour)) {
                $rankedPhoneNumber['__ranked_phone_number_points__'] += 60;
            }

            $rankedPhoneNumbers[] = (object) $rankedPhoneNumber;
        }

        usort($rankedPhoneNumbers, function ($a, $b) {
            return $b->__ranked_phone_number_points__ <=> $a->__ranked_phone_number_points__;
        });

        //sort $this->phoneNumbers based on $rankedPhoneNumbers
        $sortedPhoneNumbers = [];
        foreach ($rankedPhoneNumbers as $rankedPhoneNumber) {
            foreach ($this->phoneNumbers as $phoneNumber) {
                $number = $phoneNumber;
                if($this->phoneNumbersKeyName) {
                    if(is_array($phoneNumber)) {
                        $number = $phoneNumber[$this->phoneNumbersKeyName];
                    } elseif (is_object($phoneNumber)) {
                        $number = $phoneNumber->{$this->phoneNumbersKeyName};
                    }
                }

                if($number == $rankedPhoneNumber->number) {
                    $sortedPhoneNumbers[] = $phoneNumber;
                }
            }
        }

        $this->phoneNumbers = $sortedPhoneNumbers;

        return $this->phoneNumbers;
    }
}
