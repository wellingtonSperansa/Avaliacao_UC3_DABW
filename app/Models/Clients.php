<?php

namespace App\Models;

class Clients
{
    public ?int $id;
    public string $name;
    public string $sobre_nome;
    public string $email;
    public string $telefone;

    public function __construct(?int $id, string $name, string $sobre_nome, string $email, string $telefone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->sobre_nome = $sobre_nome;
        $this->email = $email;
        $this->telefone = $telefone;
    }
}
