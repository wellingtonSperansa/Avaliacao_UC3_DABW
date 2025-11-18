<?php
namespace App\Services;

use App\Models\Car;

class CarService {
    public function validate(array $data): array {
        $errors = [];
        $marca = trim($data['Marca'] ?? '');
    
        if ($marca === '') $errors['Marca'] = 'Marca é obrigatório';

        return $errors;
    }

    public function make(array $data): Car {
        $marca = trim($data['Marca'] ?? '');
        $modelo = trim($data['Modelo'] ?? '');
        $id = isset($data['id']) ? (int)$data['id'] : null;
        return new Car($id, $marca, $modelo);
    }
}
