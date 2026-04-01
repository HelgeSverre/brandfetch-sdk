<?php

use HelgeSverre\Brandfetch\Brandfetch;
use HelgeSverre\Brandfetch\Data\Brand;
use HelgeSverre\Brandfetch\Requests\TransactionBrand;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->brandfetch = new Brandfetch(apiKey: env('BRANDFETCH_API_KEY', 'fake-api-key'));
});

it('TransactionBrand returns brand data from transaction label', function () {
    Saloon::fake([
        TransactionBrand::class => MockResponse::fixture('transactionBrand/success'),
    ]);

    $dto = $this->brandfetch->transactionBrand('STARBUCKS 1523 OMAHA NE', 'US')->dto();

    expect($dto)->toBeInstanceOf(Brand::class)
        ->and($dto->domain)->toBe('starbucks.com')
        ->and($dto->name)->toBe('Starbucks');

    Saloon::assertSent(TransactionBrand::class);
});

it('TransactionBrand sends correct request body', function () {
    Saloon::fake([
        TransactionBrand::class => MockResponse::fixture('transactionBrand/success'),
    ]);

    $this->brandfetch->transactionBrand('AMAZON WEB SERVICES', 'US');

    Saloon::assertSent(function (TransactionBrand $request) {
        return $request->body()->all() === [
            'transactionLabel' => 'AMAZON WEB SERVICES',
            'countryCode' => 'US',
        ];
    });
});
