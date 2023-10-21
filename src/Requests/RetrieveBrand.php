<?php

namespace HelgeSverre\Brandfetch\Requests;

use GuzzleHttp\Psr7\Uri;
use HelgeSverre\Brandfetch\Data\Brand;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * @see https://docs.brandfetch.com/reference/retrieve-brand
 */
class RetrieveBrand extends Request
{
    protected Method $method = Method::GET;

    protected string|Uri $domainName;

    public function resolveEndpoint(): string
    {
        return "brands/{$this->domainName}";
    }

    public function __construct(string|Uri $domainName)
    {

        $this->domainName = $domainName instanceof Uri ? $domainName->getHost() : $domainName;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Brand::fromResponse($response);
    }
}
