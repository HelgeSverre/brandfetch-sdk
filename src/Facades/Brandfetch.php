<?php

namespace HelgeSverre\Brandfetch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HelgeSverre\Brandfetch\Brandfetch
 */
class Brandfetch extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HelgeSverre\Brandfetch\Brandfetch::class;
    }
}
