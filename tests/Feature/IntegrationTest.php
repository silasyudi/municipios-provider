<?php

namespace Tests\Feature;

use Illuminate\Support\Env;
use Tests\TestCase;

class IntegrationTest extends TestCase
{
    private const RR_IBGE = [
        ['ibge_code' => '1400027', 'name' => 'Amajari',],
        ['ibge_code' => '1400050', 'name' => 'Alto Alegre',],
        ['ibge_code' => '1400100', 'name' => 'Boa Vista',],
        ['ibge_code' => '1400159', 'name' => 'Bonfim',],
        ['ibge_code' => '1400175', 'name' => 'Cantá',],
        ['ibge_code' => '1400209', 'name' => 'Caracaraí',],
        ['ibge_code' => '1400233', 'name' => 'Caroebe',],
        ['ibge_code' => '1400282', 'name' => 'Iracema',],
        ['ibge_code' => '1400308', 'name' => 'Mucajaí',],
        ['ibge_code' => '1400407', 'name' => 'Normandia',],
        ['ibge_code' => '1400456', 'name' => 'Pacaraima',],
        ['ibge_code' => '1400472', 'name' => 'Rorainópolis',],
        ['ibge_code' => '1400506', 'name' => 'São João da Baliza',],
        ['ibge_code' => '1400605', 'name' => 'São Luiz',],
        ['ibge_code' => '1400704', 'name' => 'Uiramutã',],
    ];

    private const RR_BRASIL_API = [
        ['ibge_code' => '1400027', 'name' => 'AMAJARI',],
        ['ibge_code' => '1400050', 'name' => 'ALTO ALEGRE',],
        ['ibge_code' => '1400100', 'name' => 'BOA VISTA',],
        ['ibge_code' => '1400159', 'name' => 'BONFIM',],
        ['ibge_code' => '1400175', 'name' => 'CANTA',],
        ['ibge_code' => '1400209', 'name' => 'CARACARAI',],
        ['ibge_code' => '1400233', 'name' => 'CAROEBE',],
        ['ibge_code' => '1400282', 'name' => 'IRACEMA',],
        ['ibge_code' => '1400308', 'name' => 'MUCAJAI',],
        ['ibge_code' => '1400407', 'name' => 'NORMANDIA',],
        ['ibge_code' => '1400456', 'name' => 'PACARAIMA',],
        ['ibge_code' => '1400472', 'name' => 'RORAINOPOLIS',],
        ['ibge_code' => '1400506', 'name' => 'SAO JOAO DA BALIZA',],
        ['ibge_code' => '1400605', 'name' => 'SAO LUIZ',],
        ['ibge_code' => '1400704', 'name' => 'UIRAMUTA',],
    ];

    public function test_invalid_uf_returns_404(): void
    {
        $response = $this->get('/api/municipio/xx');
        $response->assertNotFound();
    }

    public function test_valid_uf_with_ibge_provider_returns_200(): void
    {
        Env::getRepository()->set('PROVIDER', 'IBGE');
        $response = $this->get('/api/municipio/rr');
        $response->assertJsonCount(15);
        $response->assertExactJson(self::RR_IBGE);
        $response->assertOk();
    }

    public function test_valid_uf_with_brasil_api_provider_returns_200(): void
    {
        Env::getRepository()->set('PROVIDER', 'BRASIL_API');
        $response = $this->get('/api/municipio/rr');
        $response->assertJsonCount(15);
        $response->assertSimilarJson(self::RR_BRASIL_API);
        $response->assertOk();
    }

    public function test_valid_uf_with_invalid_provider_returns_400(): void
    {
        Env::getRepository()->set('PROVIDER', 'invalid');
        $response = $this->get('/api/municipio/rr');
        $response->assertServerError();
    }
}


