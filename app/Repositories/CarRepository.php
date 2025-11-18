<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Car;
use PDO;

class CarRepository
{
    public function countAll(): int
    {
        $stmt = Database::getConnection()->query("SELECT COUNT(*) FROM car");
        return (int)$stmt->fetchColumn();
    }

    public function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = Database::getConnection()->prepare("SELECT * FROM car ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM car WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(Car $car): int
    {
        $stmt = Database::getConnection()->prepare("INSERT INTO car (Marca, Modelo) VALUES (?, ?)");
        $stmt->execute([$car->Marca, $car->Modelo]);
        return (int)Database::getConnection()->lastInsertId();
    }

    public function update(Car $car): bool
    {
        $stmt = Database::getConnection()->prepare("UPDATE car SET Marca = ?, Modelo = ? WHERE id = ?");
        return $stmt->execute([$car->Marca, $car->Modelo, $car->id]);
    }

    public function delete(int $id): bool
    {
        $stmt = Database::getConnection()->prepare("DELETE FROM car WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findAll(): array
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM car ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getArray(): array
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM car ORDER BY id DESC");
        $stmt->execute();
        $cars = $stmt->fetchAll();
        $return = [];
        foreach ($cars as $car) {
            $return[$car['id']] = $car['Marca'];
        }
        return $return;
    }
}
