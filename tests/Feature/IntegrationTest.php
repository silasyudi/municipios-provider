<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Env;
use Tests\TestCase;

class IntegrationTest extends TestCase
{
    private const RESPONSE_IBGE
        = '[{"id":"1","nome":"João Pessoa"},{"id":"2","nome":"Campina Grande"}]';
    private const RESPONSE_BRASIL_API
        = '[{"codigo_ibge":"1","nome":"JOAO PESSOA"},{"codigo_ibge":"2","nome":"CAMPINA GRANDE"}]';

    private const EXPECTED_IBGE = [
        ['ibge_code' => '1', 'name' => 'João Pessoa',],
        ['ibge_code' => '2', 'name' => 'Campina Grande',],
    ];

    private const EXPECTED_BRASIL_API = [
        ['ibge_code' => '1', 'name' => 'JOAO PESSOA',],
        ['ibge_code' => '2', 'name' => 'CAMPINA GRANDE',]
    ];

    private array $history = [];

    public function test_invalid_uf_returns_404(): void
    {
        $response = $this->get('/api/municipio/xx');
        $response->assertNotFound();
    }

    public function test_valid_uf_with_ibge_provider_returns_200(): void
    {
        Env::getRepository()->set('PROVIDER', 'IBGE');
        $this->mockThirdPartyApi(self::RESPONSE_IBGE);

        $response = $this->get('/api/municipio/pb');
        $response->assertJsonCount(2);
        $response->assertExactJson(self::EXPECTED_IBGE);
        $response->assertOk();

        $this->assertCount(1, $this->history);
        $this->assertEquals('servicodados.ibge.gov.br', $this->history[0]['request']->getUri()->getHost());
    }

    public function test_valid_uf_with_brasil_api_provider_returns_200(): void
    {
        Env::getRepository()->set('PROVIDER', 'BRASIL_API');
        $this->mockThirdPartyApi(self::RESPONSE_BRASIL_API);

        $response = $this->get('/api/municipio/pb');
        $response->assertJsonCount(2);
        $response->assertExactJson(self::EXPECTED_BRASIL_API);
        $response->assertOk();

        $this->assertCount(1, $this->history);
        $this->assertEquals('brasilapi.com.br', $this->history[0]['request']->getUri()->getHost());
    }

    public function test_valid_uf_with_invalid_provider_returns_400(): void
    {
        Env::getRepository()->set('PROVIDER', 'invalid');
        $response = $this->get('/api/municipio/pb');
        $response->assertServerError();
    }

    private function mockThirdPartyApi(string $responseBody): void
    {
        $mock = new MockHandler([
            new Response(200, [], $responseBody)
        ]);

        $this->history = [];
        $history = Middleware::history($this->history);

        $handler = HandlerStack::create($mock);
        $handler->push($history);

        $guzzle = new Client(['handler' => $handler]);

        $this->app->instance(Client::class, $guzzle);
    }
}


