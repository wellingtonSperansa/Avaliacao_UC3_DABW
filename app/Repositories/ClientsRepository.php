<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Clients;
use PDO;

class ClientsRepository {
    public function countAll(): int {
        $stmt = Database::getConnection()->query("SELECT COUNT(*) FROM clients");
        return (int)$stmt->fetchColumn();
    }
    public function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = Database::getConnection()->prepare("SELECT * FROM clients ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(Clients $clients): int
    {
        $stmt = Database::getConnection()->prepare("INSERT INTO clients (name, sobre_nome, email, telefone) VALUES (?, ?, ?, ?)");
        $stmt->execute([$clients->name, $clients->sobre_nome, $clients->email, $clients->telefone]);
        return (int)Database::getConnection()->lastInsertId();
    }

    public function update(Clients $clients): bool
    {
        $stmt = Database::getConnection()->prepare("UPDATE clients SET name = ?, sobre_nome = ?, email = ?, telefone = ? WHERE id = ?");
        return $stmt->execute([$clients->name, $clients->sobre_nome, $clients->email, $clients->telefone, $clients->id]);
    }

    public function delete(int $id): bool
    {
        $stmt = Database::getConnection()->prepare("DELETE FROM clients WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findAll(): array
    {
                $stmt = Database::getConnection()->prepare("SELECT * FROM clients ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getArray(): array
    {
        $stmt = Database::getConnection()->prepare("SELECT * FROM clients ORDER BY id DESC");
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $return = [];
        foreach ($clients as $client) {
            $return[$client['id']] = $client['name'];
        }
        return $return;
    }
}
