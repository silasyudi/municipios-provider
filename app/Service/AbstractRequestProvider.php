<?php

namespace App\Service;

use App\Enum\Estado;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractRequestProvider
{
    private Client $client;
    private SerializerInterface $serializer;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->serializer = new Serializer(
            [new PropertyNormalizer(null, new CamelCaseToSnakeCaseNameConverter()), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
    }

    final protected function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    abstract protected function getUrl(Estado $uf): string;

    abstract protected function extract(string $content): array;

    final public function request(Estado $uf): array
    {
        $url = $this->getUrl($uf);

        return $this->client->getAsync($url)
            ->then(
                function (ResponseInterface $response): array {
                    return $this->extract($response->getBody()->getContents());
                },
                function (RequestException $exception): void {
                    throw new Exception(
                        'An error occurred in the municipalities provider. Reason: ' . $exception->getMessage()
                    );
                }
            )
            ->wait();
    }
}
