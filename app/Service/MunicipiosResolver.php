<?php

namespace App\Service;

use App\Enum\Estado;

class MunicipiosResolver
{
    private AbstractRequestProvider $provider;

    public function __construct(AbstractRequestProvider $provider)
    {
        $this->provider = $provider;
    }

    public function getByUf(Estado $uf): array
    {
        return $this->provider->request($uf);
    }
}
