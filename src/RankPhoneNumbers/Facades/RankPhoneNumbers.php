<?php

namespace RankPhoneNumbers\Facades;

class RankPhoneNumbers extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \RankPhoneNumbers\RankPhoneNumbers::class;
    }
}
