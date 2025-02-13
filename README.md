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
// $ranked will be the original phone numbers array sorted by rank.
```

### With Laravel Facade
Laravel uses Package Auto-Discovery, which doesn't require you to manually add the ServiceProvider and Facade.
```php
$myNumbers = ['18005557184', '18005554030'];
$rankPhoneNumbers = RankPhoneNumbers::setPhoneNumbers($myNumbers);
$ranked = $rankPhoneNumbers->rank();
// $ranked will be the original phone numbers array sorted by rank.
```

### Example
```php
$twilioNumbers = json_decode('[
    {
        "highlighted": "+15095554030",
        "friendlyName": "(509) 555-4030",
        "phoneNumber": "+15095554030",
        "locality": "Omak",
        "region": "WA",
        "postalCode": "98841",
        "lata": "676",
        "rateCenter": "OMAK",
        "latitude": "48.364700",
        "longitude": "-119.270400",
        "isoCountry": "US",
        "addressRequirements": "none",
        "beta": false,
        "capabilities": {
        "voice": true,
            "SMS": true,
            "MMS": true
        },
        "request_number": true
    },
    {
        "highlighted": "+15095557780",
        "friendlyName": "(509) 555-7780",
        "phoneNumber": "+15095557780",
        "locality": "Ritzville",
        "region": "WA",
        "postalCode": "99169",
        "lata": "676",
        "rateCenter": "RITZVILLE",
        "latitude": "47.079600",
        "longitude": "-118.470500",
        "isoCountry": "US",
        "addressRequirements": "none",
        "beta": false,
        "capabilities": {
        "voice": true,
            "SMS": true,
            "MMS": true
        },
        "request_number": true
    }
]');

$rankPhoneNumbers = RankPhoneNumbers::setPhoneNumbers($twilioNumbers);
$rankPhoneNumbers->setPhoneNumbersKeyName('phoneNumber');
$ranked = $rankPhoneNumbers->rank();
// $ranked will be the original phone numbers array sorted by rank 
```

## Methods

### setPhoneNumbers(array $phoneNumbers): self

Sets the phone numbers to be ranked.

### setPhoneNumbersKeyName(string $phoneNumbersKeyName): self

Sets the key name where the phone numbers are stored in associative arrays or object.

### rank(): array

Returns the original phone numbers array sorted by rank.


### Add Rules

```php
$rankPhoneNumbers = new RankPhoneNumbers\RankPhoneNumbers;
$rankPhoneNumbers->setPhoneNumbers($phoneNumbers);
$rankPhoneNumbers->setPhoneNumbersKeyName('phoneNumber');
$rankPhoneNumbers->addRule(new App\RepeatsInARow);
```

## Rules

### Default Rules

- double_match
- ends_in_zero_or_five
- funny_69
- funny_420
- partial_sequential_numbers
- pattern_135
- pattern_246
- pattern_357
- pattern_369
- pattern_468
- pattern_579
- pattern_642
- pattern_753
- pattern_864
- pattern_963
- pattern_975
- pattern_two_increment
- pattern_x2y2
- repeats_in_a_row
- same_numbers
- sequential_numbers
- song_865
- song_5309
- symmetrical
- two_from_end_is_zero_or_five

### Modify Rules

```php
$rankPhoneNumbers = new RankPhoneNumbers\RankPhoneNumbers;
$rankPhoneNumbers->setPhoneNumbers($phoneNumbers);
$rankPhoneNumbers->rules['repeats_in_a_row']->points = 123;
```

## TODO

- [ ] Add tests
- [ ] Be able to assign the point value to each rule inside of rank()
- [ ] Be able to add your own custom rules for ranking
- [ ] Add documentation
