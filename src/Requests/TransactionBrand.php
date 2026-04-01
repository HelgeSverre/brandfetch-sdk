<?php

namespace HelgeSverre\Brandfetch\Requests;

use HelgeSverre\Brandfetch\Data\Brand;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * @see https://docs.brandfetch.com/reference/transaction-brand
 */
class TransactionBrand extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $transactionLabel,
        protected string $countryCode = 'US',
    ) {}

    public function resolveEndpoint(): string
    {
        return '/v2/brands/transaction';
    }

    /**
     * @return array<string, string>
     */
    protected function defaultBody(): array
    {
        return [
            'transactionLabel' => $this->transactionLabel,
            'countryCode' => $this->countryCode,
        ];
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Brand::fromResponse($response);
    }
}
