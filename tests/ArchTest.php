<?php

it('can test', fn () => expect(true)->toBeTrue());

it('will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();

it('All request classes extend the saloon request class')
    ->expect('HelgeSverre\Brandfetch\Requests')
    ->classes()
    ->toExtend('Saloon\Http\Request');
