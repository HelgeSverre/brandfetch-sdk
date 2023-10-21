<?php

/** @noinspection PhpUnhandledExceptionInspection */

use HelgeSverre\Brandfetch\Brandfetch;
use HelgeSverre\Brandfetch\Requests\SearchBrand;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->brandfetch = new Brandfetch(apiKey: env('BRANDFETCH_API_KEY', 'fake-api-key'));
});

it('SearchBrand returns a single result', closure: function () {

    Saloon::fake([
        SearchBrand::class => MockResponse::fixture('searchBrand.single'),
    ]);

    $response = $this->brandfetch->searchBrand('brandfetch', 'helgesver.re');

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->body())->json();

    //    Saloon::assertSent('/v2/brands/brandfetch.com');
    Saloon::assertSent(SearchBrand::class);
});

it('SearchBrand returns a multiple results', closure: function () {

    Saloon::fake([
        SearchBrand::class => MockResponse::fixture('searchBrand.multiple'),
    ]);

    $response = $this->brandfetch->searchBrand('google', 'helgesver.re');

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->body())->json();

    Saloon::assertSent('/v2/search/google');
    Saloon::assertSent(SearchBrand::class);
});

it('SearchBrand returns no results', closure: function () {

    Saloon::fake([
        SearchBrand::class => MockResponse::fixture('searchBrand.empty'),
    ]);
    $response = $this->brandfetch->searchBrand('invalid-domain-should-fail-horribly', 'helgesver.re');

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->body())->json();

    Saloon::assertSent('/v2/search/invalid-domain-should-fail-horribly');
    Saloon::assertSent(SearchBrand::class);
});
