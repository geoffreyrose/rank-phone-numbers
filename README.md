<div style="text-align: center;"> 

[![Latest Stable Version](https://img.shields.io/packagist/v/geoffreyrose/rank-phone-numbers?style=flat-square)](https://packagist.org/packages/geoffreyrose/rank-phone-numbers)
[![License](https://img.shields.io/github/license/geoffreyrose/rank-phone-numbers?style=flat-square)](https://github.com/geoffreyrose/rank-phone-numbers/blob/main/LICENSE)
</div>
 
# !!IN BETA!!
# Find The Best Phone Number!  PHP + Laravel Facade

A PHP/Laravel package to rank phone numbers to help you find the best ones. Great for when you have a list of phone numbers, and you want to find the best one to use.

Works great with Twilio, Bandwidth, Vonage, SignalWire or any other programmable communication provider to help you find the best phone number to use.


### Requirements
* PHP 8.4+

### Usage

#### Installation
```
composer require geoffreyrose/rank-phone-numbers
```

### With Plain PHP
```php
use RankPhoneNumbers\RankPhoneNumbers;

...
$myNumbers = ['18005557184', '18005554030'];
$rankPhoneNumbers = new RankPhoneNumbers\RankPhoneNumbers;
$rankPhoneNumbers->setPhoneNumbers($myNumbers);
$ranked = $rankPhoneNumbers->rank();

// $ranked
[
    [0] => (object) [
        "phone_number" => "18005554030"
        "rank_phone_number_points" => 175
        "rank_phone_number_word_match_end" => []
    ],
    [1] => (object) [
        "phone_number"] => "18005557184"
        "rank_phone_number_points" => 0
        "rank_phone_number_word_match_end" =>  []
    ]
]
```

### With Laravel Facade
Laravel uses Package Auto-Discovery, which doesn't require you to manually add the ServiceProvider and Facade.
```php
$myNumbers = ['18005557184', '18005554030'];
$rankPhoneNumbers = RankPhoneNumbers::setPhoneNumbers($myNumbers);
$ranked = $rankPhoneNumbers->rank();

// $ranked
[
    [0] => (object) [
        "phone_number" => "18005554030"
        "rank_phone_number_points" => 175
        "rank_phone_number_word_match_end" => []
    ],
    [1] => (object) [
        "phone_number"] => "18005557184"
        "rank_phone_number_points" => 0
        "rank_phone_number_word_match_end" =>  []
    ]
]
```

### Example
```php
$twilioNumbers = [
    (object) [
        "highlighted" => "+15095554030",
        "friendlyName" => "(509) 555-4030",
        "phoneNumber" => "+15095554030",
        "locality" => "Omak",
        "region" => "WA",
        "postalCode" => "98841",
        "lata" => "676",
        "rateCenter" => "OMAK",
        "latitude" => "48.364700",
        "longitude" => "-119.270400",
        "isoCountry" => "US",
        "addressRequirements" => "none",
        "beta" => false,
        "capabilities" => (object)[
            "voice" => true,
            "SMS" => true,
            "MMS" => true
        ],
        "request_number" => true
    ],
    (object) [
        "highlighted" => "+15095557780",
        "friendlyName" => "(509) 555-7780",
        "phoneNumber" => "+15095557780",
        "locality" => "Ritzville",
        "region" => "WA",
        "postalCode" => "99169",
        "lata" => "676",
        "rateCenter" => "RITZVILLE",
        "latitude" => "47.079600",
        "longitude" => "-118.470500",
        "isoCountry" => "US",
        "addressRequirements" => "none",
        "beta" => false,
        "capabilities" => (object)[
            "voice" => true,
            "SMS" => true,
            "MMS" => true
        ],
        "request_number" => true
    ],
    (object) [
        "highlighted" => "+15095558683",
        "friendlyName" => "(509) 555-8683",
        "phoneNumber" => "+15095558683",
        "locality" => "Ritzville",
        "region" => "WA",
        "postalCode" => "99169",
        "lata" => "676",
        "rateCenter" => "RITZVILLE",
        "latitude" => "47.079600",
        "longitude" => "-118.470500",
        "isoCountry" => "US",
        "addressRequirements" => "none",
        "beta" => false,
        "capabilities" => (object)[
            "voice" => true,
            "SMS" => true,
            "MMS" => true
        ],
        "request_number" => true
    ]
];

$rankPhoneNumbers = RankPhoneNumbers::setPhoneNumbers($twilioNumbers);
$rankPhoneNumbers->setPhoneNumbersKeyName('phoneNumber');
$ranked = $rankPhoneNumbers->rank();
// $ranked

[
    [0] => (object) [
        "highlighted" => "+15095557780",
        "friendlyName" => "(509) 555-7780",
        "phoneNumber" => "+15095557780",
        "locality" => "Ritzville",
        "region" => "WA",
        "postalCode" => "99169",
        "lata" => "676",
        "rateCenter" => "RITZVILLE",
        "latitude" => "47.079600",
        "longitude" => "-118.470500",
        "isoCountry" => "US",
        "addressRequirements" => "none",
        "beta" => false,
        "capabilities" => (object)[
            "voice" => true,
            "SMS" => true,
            "MMS" => true
        ],
        "request_number" => true,
        "rank_phone_number_points" => 225
        "rank_phone_number_word_match_end" =>  []
    ],
    [1] => (object) [
        "highlighted" => "+15095554030",
        "friendlyName" => "(509) 555-4030",
        "phoneNumber" => "+15095554030",
        "locality" => "Omak",
        "region" => "WA",
        "postalCode" => "98841",
        "lata" => "676",
        "rateCenter" => "OMAK",
        "latitude" => "48.364700",
        "longitude" => "-119.270400",
        "isoCountry" => "US",
        "addressRequirements" => "none",
        "beta" => false,
        "capabilities" => (object)[
            "voice" => true,
            "SMS" => true,
            "MMS" => true
        ],
        "request_number" => true,
        "rank_phone_number_points" => 175
        "rank_phone_number_word_match_end" =>  []
    ],
    [2] => (object) [
        "highlighted" => "+15095558683",
        "friendlyName" => "(509) 555-8683",
        "phoneNumber" => "+15095558683",
        "locality" => "Ritzville",
        "region" => "WA",
        "postalCode" => "99169",
        "lata" => "676",
        "rateCenter" => "RITZVILLE",
        "latitude" => "47.079600",
        "longitude" => "-118.470500",
        "isoCountry" => "US",
        "addressRequirements" => "none",
        "beta" => false,
        "capabilities" => (object)[
            "voice" => true,
            "SMS" => true,
            "MMS" => true
        ],
        "request_number" => true,
        "rank_phone_number_points" => 80
        "rank_phone_number_word_match_end" => [
            "vote"
        ]
    ]
];
```

## Methods

### setPhoneNumbers(array $phoneNumbers): self

Sets the phone numbers to be ranked


### setPhoneNumbersKeyName(string $phoneNumbersKeyName): self

Sets the key name of the phone number when using an associative array or object


### addRule($rule): self

Adds a rule to the ranking system. Must extend \RankPhoneNumbers\Abstracts\RuleAbstract

### addWordRule($rule): self

Adds a word rule to the ranking system. Must extend \RankPhoneNumbers\Abstracts\WordRuleAbstract

### rank(): array

Ranks the phone numbers. Returning an array of the phone numbers sorted by rank.

Includes the rank_phone_number_points and rank_phone_number_word_match_end properties.


## Rules

### Default Rules

Rules look at last four digits of the phone number.

- double_match (100 Points) // 2323
- ends_in_zero_or_five (50 Points) // XXX0 or XXX5
- funny_69 (10 Points) // XX69
- funny_420 (10 Points) // X420
- partial_sequential_numbers (90 Points) // 123X or X134, etc
- pattern_135 (60 Points) // 135X or X135
- pattern_246 (60 Points) // 246X or X246
- pattern_357 (60 Points) // 357X or X357
- pattern_369 (60 Points) // 369X or X369
- pattern_468 (60 Points) // 468X or X468
- pattern_579 (60 Points) // 579X or X579
- pattern_642 (60 Points) // 642X or X642
- pattern_753 (60 Points) // 753X or X753
- pattern_864 (60 Points) // 864X or X864
- pattern_963 (60 Points) // 963X or X963
- pattern_975 (60 Points) // 975X or X975
- pattern_two_increment (60 Points) // 123X or X123
- pattern_x2y2 (50 Points) // X2Y2
- repeats_in_a_row (100 Points) // 2323
- same_numbers (75 Points) // 2XX2, 2X2X 22XX, 22X2, 222X, etc
- sequential_numbers (100 Points) // 1234
- song_865 (10 Points)  // X865 or 865X
- song_5309 (100 Points) // 5309
- symmetrical (100 Points) // 5225, 1221, etc
- two_from_end_is_zero_or_five (50 Points) // XX0X or XX5X

### Modify Rules

```php
$rankPhoneNumbers = new RankPhoneNumbers\RankPhoneNumbers;
$rankPhoneNumbers->setPhoneNumbers($phoneNumbers);
$rankPhoneNumbers->rules['repeats_in_a_row']->points = 123;
```

### Add Rule

```php
namespace App;

use RankPhoneNumbers\Abstracts\RuleAbstract;

class MyCustomRule extends RuleAbstract
{
    public function __construct()
    {
        $this->pattern = '/3792/';
        $this->points = 500;
        $this->name = 'my_custom_rule';
    }
}

... 
 
$rankPhoneNumbers = new RankPhoneNumbers\RankPhoneNumbers;
$rankPhoneNumbers->addRule(new App\MyCustomRule);
```

### Word Rules

The list of words that is checked against is mostly the words from the Oxford 5000, which is a list of 5000 words you should understand for a1-b2 english literacy. The list is trimmed down to be about 3000 words that are length 4-7 long.

Checks the last four, five, six, and seven letters of the phone number to see if it is a word in T9 conversion.

### Default Word Rules

- word_is_last_four (5 Points)
- word_is_last_five (5 Points)
- word_is_last_six (5 Points)
- word_is_last_seven (5 Points)

### Modify Word Rules

```php
$rankPhoneNumbers = new RankPhoneNumbers\RankPhoneNumbers;
$rankPhoneNumbers->wordRules['word_is_last_four']->points = 75;
```


### Rule Abstracts and Word Rule Abstracts

All defaults can be updated as needed. 

For example, to change the points of a rule:
```php
$rankPhoneNumbers = new RankPhoneNumbers\RankPhoneNumbers;
$rankPhoneNumbers->wordRules['word_is_last_four']->points = 75;
$rankPhoneNumbers->rules['repeats_in_a_row']->points = 123;`
```

#### Rule Properties

- name: string
- points: int
- pattern: string

#### Word Rule Properties

If you want to disable a specific word rule, set `isActive` to false.
- name: string
- points: int
- isActive: bool
- endingDigitsToCheck: int


## TODO

- [ ] Add Tests
- [ ] Documentation
