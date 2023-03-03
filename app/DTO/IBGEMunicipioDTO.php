<?php

namespace App\DTO;

class IBGEMunicipioDTO
{
    private string $id;
    private string $nome;

    public function getId(): string
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}
