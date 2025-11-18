<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Supplier;
use PDO;

class SupplierRepository {
    public function countAll(): int {
        $stmt = Database::getConnection()->query("SELECT COUNT(*) FROM suppliers");
        return (int)$stmt->fetchColumn();
    }
    public function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = Database::getConnection()->prepare("SELECT * FROM suppliers ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM suppliers WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(Supplier $supplier): int
    {
        $stmt = Database::getConnection()->prepare("INSERT INTO suppliers (name, cnpj, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$supplier->name, $supplier->cnpj, $supplier->email, $supplier->telefone, $supplier->endereco]);
        return (int)Database::getConnection()->lastInsertId();
    }

    public function update(Supplier $supplier): bool
    {
        $stmt = Database::getConnection()->prepare("UPDATE suppliers SET name = ?, cnpj = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?");
        return $stmt->execute([$supplier->name, $supplier->cnpj, $supplier->email, $supplier->telefone, $supplier->endereco, $supplier->id]);
    }

    public function delete(int $id): bool
    {
        $stmt = Database::getConnection()->prepare("DELETE FROM suppliers WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findAll(): array
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM suppliers ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getArray(): array
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM suppliers ORDER BY id DESC");
        $stmt->execute();
        $suppliers = $stmt->fetchAll();
        $return = [];
        foreach ($suppliers as $supplier) {
            $return[$supplier['id']] = $supplier['name'];
        }
        return $return;
    }
}

