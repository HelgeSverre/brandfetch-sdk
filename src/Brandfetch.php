<?php

namespace HelgeSverre\Brandfetch;

use GuzzleHttp\Psr7\Uri;
use HelgeSverre\Brandfetch\Requests\RetrieveBrand;
use HelgeSverre\Brandfetch\Requests\SearchBrand;
use HelgeSverre\Brandfetch\Requests\TransactionBrand;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use SensitiveParameter;

class Brandfetch extends Connector
{
    public function __construct(
        #[SensitiveParameter]
        protected string $apiKey
    ) {
        $this->withTokenAuth($this->apiKey);
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.brandfetch.io';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function retrieveBrand(string|Uri $domainName): Response
    {
        return $this->send(new RetrieveBrand($domainName));
    }

    public function searchBrand(string $brandName, string $referer = 'https://github.com/HelgeSverre/brandfetch-sdk'): Response
    {
        return $this->send(new SearchBrand($brandName, $referer));
    }

    public function transactionBrand(string $transactionLabel, string $countryCode = 'US'): Response
    {
        return $this->send(new TransactionBrand($transactionLabel, $countryCode));
    }

    // Shortcut for convenience
    public function logo(string $domainName): ?string
    {
        return rescue(fn () => $this->retrieveBrand($domainName)->json('logos.0.formats.0.src'), report: false);
    }
}
