<?php

namespace Tests\Unit\Service;

use App\Enum\Estado;
use App\Service\AbstractRequestProvider;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

abstract class AbstractRequestProviderTestCase extends TestCase
{
    private const EXPECTED_RESULT = [
        ['ibge_code' => '1', 'name' => 'João Pessoa'],
        ['ibge_code' => '2', 'name' => 'Campina Grande']
    ];

    public function test_request_should_return_array_of_municipios(): void
    {
        $result = $this->getProviderGoodResponse()->request(Estado::PB);
        $this->assertEquals(self::EXPECTED_RESULT, $result);
    }

    public function test_request_error_on_provider_should_throw_exception(): void
    {
        $this->expectException(Exception::class);
        $this->getProviderBadResponse()->request(Estado::PB);
    }

    private function getProviderGoodResponse(): AbstractRequestProvider
    {
        return $this->getProvider(new Response(200, [], $this->getMockResult()));
    }

    private function getProviderBadResponse(): AbstractRequestProvider
    {
        return $this->getProvider(new Response(500, [], 'Error Communicating with Server'));
    }

    private function getProvider(Response $response): AbstractRequestProvider
    {
        $mock = new MockHandler([$response]);
        $client = new Client(['handler' => HandlerStack::create($mock)]);
        return $this->createProvider($client);
    }

    abstract protected function getMockResult(): string;

    abstract protected function createProvider(Client $client): AbstractRequestProvider;
}
