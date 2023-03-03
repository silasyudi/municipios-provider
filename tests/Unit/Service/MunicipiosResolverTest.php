<?php

namespace Tests\Unit\Service;

use App\Enum\Estado;
use App\Service\AbstractRequestProvider;
use App\Service\MunicipiosResolver;
use PHPUnit\Framework\TestCase;

class MunicipiosResolverTest extends TestCase
{
    public function test_get_by_uf_should_return_list_of_municipios(): void
    {
        $provider = $this->createMock(AbstractRequestProvider::class);
        $provider->expects(self::once())
            ->method('request')
            ->with(Estado::PB)
            ->willReturn(['ibge_code' => '1', 'nome' => 'João Pessoa']);

        $lista = (new MunicipiosResolver($provider))->getByUf(Estado::PB);
        $this->assertEquals(['ibge_code' => '1', 'nome' => 'João Pessoa'], $lista);
    }
}
