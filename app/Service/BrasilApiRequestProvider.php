<?php

namespace App\Service;

use App\DTO\BrasilApiMunicipioDTO;
use App\Enum\Estado;

class BrasilApiRequestProvider extends AbstractRequestProvider
{
    private const URL = 'https://brasilapi.com.br/api/ibge/municipios/v1/%s';

    protected function getUrl(Estado $uf): string
    {
        return sprintf(self::URL, $uf->value);
    }

    protected function extract(string $content): array
    {
        /** @var BrasilApiMunicipioDTO[] $municipios */
        $municipios = $this->getSerializer()->deserialize(
            $content,
            'App\DTO\BrasilApiMunicipioDTO[]',
            'json'
        );

        return array_map(function (BrasilApiMunicipioDTO $municipio) {
            return ['ibge_code' => $municipio->getCodigoIbge(), 'name' => $municipio->getNome()];
        }, $municipios);
    }
}
