<?php

namespace App\Http\Controllers;

use App\Enum\Estado;
use App\Service\MunicipiosResolver;
use Illuminate\Http\JsonResponse;

class MunicipioController extends Controller
{
    private MunicipiosResolver $municipiosResolver;

    public function __construct(MunicipiosResolver $municipiosResolver)
    {
        $this->municipiosResolver = $municipiosResolver;
    }

    public function get(Estado $uf): JsonResponse
    {
        $municipios = $this->municipiosResolver->getByUf($uf);
        return new JsonResponse($municipios);
    }
}
