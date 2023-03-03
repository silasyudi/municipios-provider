<?php

namespace Tests\Unit\Service;

use App\Service\AbstractRequestProvider;
use App\Service\BrasilApiRequestProvider;
use GuzzleHttp\Client;

class BrasilApiRequestProviderTest extends AbstractRequestProviderTest
{
    protected function getMockResult(): string
    {
        return '[{"codigo_ibge":"1","nome":"João Pessoa"},{"codigo_ibge":"2","nome":"Campina Grande"}]';
    }

    protected function createProvider(Client $client): AbstractRequestProvider
    {
        return new BrasilApiRequestProvider($client);
    }
}
