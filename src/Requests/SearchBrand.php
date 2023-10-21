<?php

namespace HelgeSverre\Brandfetch\Requests;

use HelgeSverre\Brandfetch\Data\SearchResult;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * @see https://docs.brandfetch.com/reference/search-brand
 */
class SearchBrand extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected string $brandName, protected string $referer)
    {

    }

    public function resolveEndpoint(): string
    {
        return "search/{$this->brandName}";
    }

    protected function defaultHeaders(): array
    {
        return [
            'Referer' => $this->referer,
        ];
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return SearchResult::fromResponse($response);
    }
}
