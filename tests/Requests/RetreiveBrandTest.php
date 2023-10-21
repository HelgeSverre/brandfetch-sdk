<?php

/** @noinspection PhpUnhandledExceptionInspection */

use HelgeSverre\Brandfetch\Brandfetch;
use HelgeSverre\Brandfetch\Requests\RetrieveBrand;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

beforeEach(function () {
    $this->brandfetch = new Brandfetch(apiKey: env('BRANDFETCH_API_KEY', 'fake-api-key'));
});

it('RetrieveBrand returns complete response', closure: function () {

    Saloon::fake([
        RetrieveBrand::class => MockResponse::fixture('retrieveBrand.full'),
    ]);

    $response = $this->brandfetch->retrieveBrand('brandfetch.com');

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->body())->json();

    Saloon::assertSent('/v2/brands/brandfetch.com');
    Saloon::assertSent(RetrieveBrand::class);
});

it('RetrieveBrand returns response for autostrada.no', closure: function () {

    Saloon::fake([
        RetrieveBrand::class => MockResponse::fixture('retrieveBrand.brand-autostrada'),
    ]);
    $response = $this->brandfetch->retrieveBrand('autostrada.no');

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->body())->json();

    Saloon::assertSent('/v2/brands/autostrada.no');
    Saloon::assertSent(RetrieveBrand::class);
});

it('RetrieveBrand returns response for helgesver.re', closure: function () {

    Saloon::fake([
        RetrieveBrand::class => MockResponse::fixture('retrieveBrand.brand-helgesverre'),
    ]);
    $response = $this->brandfetch->retrieveBrand('helgesver.re');

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->body())->json();

    Saloon::assertSent('/v2/brands/helgesver.re');
    Saloon::assertSent(RetrieveBrand::class);
});

it('RetrieveBrand returns response for google.com', closure: function () {

    Saloon::fake([
        RetrieveBrand::class => MockResponse::fixture('retrieveBrand.brand-google'),
    ]);
    $response = $this->brandfetch->retrieveBrand('google.com');

    expect($response->status())->toBe(200)
        ->and($response->json())->toBeArray()
        ->and($response->body())->json();

    Saloon::assertSent('/v2/brands/google.com');
    Saloon::assertSent(RetrieveBrand::class);
});

it('RetrieveBrand returns no response', closure: function () {

    Saloon::fake([
        RetrieveBrand::class => MockResponse::fixture('retrieveBrand.no-response'),
    ]);
    $response = $this->brandfetch->retrieveBrand('invalid-domain-should-fail-horribly.com');

    expect($response->status())->toBe(404)
        ->and($response->json('message'))->toEqual('Invalid Domain Name');

    Saloon::assertSent(RetrieveBrand::class);
});
