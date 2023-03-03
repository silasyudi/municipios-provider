<?php

namespace Tests\Unit\Service;

use App\Service\AbstractRequestProvider;
use App\Service\IBGERequestProvider;
use GuzzleHttp\Client;

class IBGERequestProviderTest extends AbstractRequestProviderTestCase
{
    protected function getMockResult(): string
    {
        return '[{"id":"1","nome":"João Pessoa"},{"id":"2","nome":"Campina Grande"}]';
    }

    protected function createProvider(Client $client): AbstractRequestProvider
    {
        return new IBGERequestProvider($client);
    }
}
