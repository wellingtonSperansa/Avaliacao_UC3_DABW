<?php

namespace App\Models;

class Car
{
    public ?int $id;
    public string $Marca;
    public string $Modelo;

    public function __construct(?int $id, string $Marca, string $Modelo)
    {
        $this->id = $id;
        $this->Marca = $Marca;
        $this->Modelo = $Modelo;
    }
}
