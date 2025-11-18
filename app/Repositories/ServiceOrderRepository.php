<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\ServiceOrder;
use PDO;

class ServiceOrderRepository {
    public function countAll(): int {
        $stmt = Database::getConnection()->query("SELECT COUNT(*) FROM service_orders");
        return (int)$stmt->fetchColumn();
    }
    
    public function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = Database::getConnection()->prepare("
            SELECT so.*, c.name as client_name 
            FROM service_orders so 
            LEFT JOIN clients c ON so.client_id = c.id 
            ORDER BY so.id DESC 
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare("
            SELECT so.*, c.name as client_name, c.email as client_email, c.telefone as client_telefone
            FROM service_orders so 
            LEFT JOIN clients c ON so.client_id = c.id 
            WHERE so.id = ?
        ");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(ServiceOrder $serviceOrder): int
    {
        $stmt = Database::getConnection()->prepare("
            INSERT INTO service_orders 
            (client_id, numero_os, tipo_servico, data_abertura, status, descricao_problema, descricao_servico, observacoes, valor_total) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $serviceOrder->client_id,
            $serviceOrder->numero_os,
            $serviceOrder->tipo_servico,
            $serviceOrder->data_abertura,
            $serviceOrder->status,
            $serviceOrder->descricao_problema,
            $serviceOrder->descricao_servico,
            $serviceOrder->observacoes,
            $serviceOrder->valor_total
        ]);
        return (int)Database::getConnection()->lastInsertId();
    }

    public function update(ServiceOrder $serviceOrder): bool
    {
        $stmt = Database::getConnection()->prepare("
            UPDATE service_orders 
            SET client_id = ?, numero_os = ?, tipo_servico = ?, data_abertura = ?, status = ?, 
                descricao_problema = ?, descricao_servico = ?, observacoes = ?, valor_total = ? 
            WHERE id = ?
        ");
        return $stmt->execute([
            $serviceOrder->client_id,
            $serviceOrder->numero_os,
            $serviceOrder->tipo_servico,
            $serviceOrder->data_abertura,
            $serviceOrder->status,
            $serviceOrder->descricao_problema,
            $serviceOrder->descricao_servico,
            $serviceOrder->observacoes,
            $serviceOrder->valor_total,
            $serviceOrder->id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = Database::getConnection()->prepare("DELETE FROM service_orders WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findAll(): array
    {
        $stmt = Database::getConnection()->prepare("
            SELECT so.*, c.name as client_name 
            FROM service_orders so 
            LEFT JOIN clients c ON so.client_id = c.id 
            ORDER BY so.id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function generateNumeroOS(): string
    {
        $year = date('Y');
        $stmt = Database::getConnection()->prepare("
            SELECT COUNT(*) as total 
            FROM service_orders 
            WHERE YEAR(created_at) = ?
        ");
        $stmt->execute([$year]);
        $result = $stmt->fetch();
        $nextNumber = ($result['total'] ?? 0) + 1;
        return sprintf('OS-%s-%04d', $year, $nextNumber);
    }
}

