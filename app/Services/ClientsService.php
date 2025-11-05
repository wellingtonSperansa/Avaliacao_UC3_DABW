<?php
namespace App\Services;

use App\Models\Clients;

class ClientsService {
    public function validate(array $data): array {
        $errors = [];
        $name = trim($data['name'] ?? '');
        $sobre_nome = trim($data['sobre_nome'] ?? '');
        $email = trim($data['email'] ?? '');
        $telefone = trim($data['telefone'] ?? '');
        if ($name === '') $errors['name'] = 'Nome é obrigatório';
        if ($sobre_nome === '') $errors['sobre_nome'] = 'Sobrenome é obrigatório';
        if ($email === '') $errors['email'] = 'E-mail é obrigatório';
        if ($telefone === '') $errors['telefone'] = 'Telefone é obrigatório';

        return $errors;
    }

    public function make(array $data): Clients {
        $name = trim($data['name'] ?? '');
        $sobre_nome = trim($data['sobre_nome'] ?? '');
        $email = trim($data['email'] ?? '');
        $telefone = trim($data['telefone'] ?? '');
        $id = isset($data['id']) ? (int)$data['id'] : null;
        return new Clients($id, $name, $sobre_nome, $email, $telefone);
    }
}
