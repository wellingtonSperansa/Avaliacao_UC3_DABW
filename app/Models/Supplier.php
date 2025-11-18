<?php

namespace App\Models;

class Supplier
{
    public ?int $id;
    public string $name;
    public string $cnpj;
    public string $email;
    public string $telefone;
    public string $endereco;

    public function __construct(?int $id, string $name, string $cnpj, string $email, string $telefone, string $endereco)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cnpj = $cnpj;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
    }
}

