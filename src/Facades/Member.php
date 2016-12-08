<?php

namespace KSD\Member\Facades;

use Illuminate\Support\Facades\Facade;

class Member extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Member';
    }
}
