<?php
namespace App\Services;

use App\Models\Supplier;

class SupplierService {
    public function validate(array $data): array {
        $errors = [];
        $name = trim($data['name'] ?? '');
        $cnpj = trim($data['cnpj'] ?? '');
        $email = trim($data['email'] ?? '');
        $telefone = trim($data['telefone'] ?? '');
        $endereco = trim($data['endereco'] ?? '');
        
        if ($name === '') $errors['name'] = 'Nome é obrigatório';
        if ($cnpj === '') $errors['cnpj'] = 'CNPJ é obrigatório';
        if ($email === '') $errors['email'] = 'E-mail é obrigatório';
        if ($telefone === '') $errors['telefone'] = 'Telefone é obrigatório';
        if ($endereco === '') $errors['endereco'] = 'Endereço é obrigatório';

        return $errors;
    }

    public function make(array $data): Supplier {
        $name = trim($data['name'] ?? '');
        $cnpj = trim($data['cnpj'] ?? '');
        $email = trim($data['email'] ?? '');
        $telefone = trim($data['telefone'] ?? '');
        $endereco = trim($data['endereco'] ?? '');
        $id = isset($data['id']) ? (int)$data['id'] : null;
        return new Supplier($id, $name, $cnpj, $email, $telefone, $endereco);
    }
}

