<?php

namespace HelgeSverre\Brandfetch;

use GuzzleHttp\Psr7\Uri;
use HelgeSverre\Brandfetch\Requests\RetrieveBrand;
use HelgeSverre\Brandfetch\Requests\SearchBrand;
use Saloon\Http\Connector;
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
        return 'https://api.brandfetch.io/v2';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function retrieveBrand(string|Uri $domainName)
    {
        return $this->send(new RetrieveBrand($domainName));
    }

    public function searchBrand(string $brandName, string $referer)
    {
        return $this->send(new SearchBrand($brandName, $referer));
    }
}
