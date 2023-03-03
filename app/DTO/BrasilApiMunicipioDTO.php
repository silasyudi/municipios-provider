<?php

namespace App\DTO;

class BrasilApiMunicipioDTO
{
    private string $codigoIbge;
    private string $nome;

    public function getCodigoIbge(): string
    {
        return $this->codigoIbge;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}
