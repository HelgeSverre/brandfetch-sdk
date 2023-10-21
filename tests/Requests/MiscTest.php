<?php

/** @noinspection PhpUnhandledExceptionInspection */

use HelgeSverre\Brandfetch\Brandfetch;
use HelgeSverre\Brandfetch\Data\Brand;
use HelgeSverre\Brandfetch\Requests\RetrieveBrand;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->brandfetch = new Brandfetch(apiKey: env('BRANDFETCH_API_KEY', 'fake-api-key'));
});

it('Can get a logo url with the convenience method', closure: function () {

    Saloon::fake([
        RetrieveBrand::class => MockResponse::fixture('misc.logo'),
    ]);

    /** @var Brand $dto */
    $logoUrl = $this->brandfetch->logo('power.no');

    dump($logoUrl);

    expect($logoUrl)->toEqual('https://asset.brandfetch.io/idNTxrFioD/idwaNnx4aT.png');
});
