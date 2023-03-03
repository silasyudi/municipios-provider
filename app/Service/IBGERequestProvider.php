<?php

namespace App\Service;

use App\DTO\IBGEMunicipioDTO;
use App\Enum\Estado;

class IBGERequestProvider extends AbstractRequestProvider
{
    private const URL = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/%s/municipios';

    protected function getUrl(Estado $uf): string
    {
        return sprintf(self::URL, $uf->value);
    }

    protected function extract(string $content): array
    {
        /** @var IBGEMunicipioDTO[] $municipios */
        $municipios = $this->getSerializer()->deserialize(
            $content,
            'App\DTO\IBGEMunicipioDTO[]',
            'json'
        );

        return array_map(function (IBGEMunicipioDTO $municipio) {
            return ['ibge_code' => $municipio->getId(), 'name' => $municipio->getNome()];
        }, $municipios);
    }
}
