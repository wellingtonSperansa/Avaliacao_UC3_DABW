<?php
namespace App\Services;

use App\Models\ServiceOrder;
use App\Repositories\ServiceOrderRepository;

class ServiceOrderService {
    public function validate(array $data): array {
        $errors = [];
        $client_id = trim($data['client_id'] ?? '');
        $tipo_servico = trim($data['tipo_servico'] ?? '');
        $data_abertura = trim($data['data_abertura'] ?? '');
        $descricao_problema = trim($data['descricao_problema'] ?? '');
        $valor_total = trim($data['valor_total'] ?? '0');
        
        if ($client_id === '') $errors['client_id'] = 'Cliente é obrigatório';
        if ($tipo_servico === '') $errors['tipo_servico'] = 'Tipo de serviço é obrigatório';
        if ($data_abertura === '') $errors['data_abertura'] = 'Data de abertura é obrigatória';
        if ($descricao_problema === '') $errors['descricao_problema'] = 'Descrição do problema é obrigatória';
        
        if ($valor_total !== '' && !is_numeric($valor_total)) {
            $errors['valor_total'] = 'Valor total deve ser um número válido';
        }

        return $errors;
    }

    public function make(array $data): ServiceOrder {
        $client_id = isset($data['client_id']) ? (int)$data['client_id'] : 0;
        $numero_os = trim($data['numero_os'] ?? '');
        $tipo_servico = trim($data['tipo_servico'] ?? '');
        $data_abertura = trim($data['data_abertura'] ?? '');
        $status = trim($data['status'] ?? 'aberta');
        $descricao_problema = trim($data['descricao_problema'] ?? '');
        $descricao_servico = trim($data['descricao_servico'] ?? '');
        $observacoes = trim($data['observacoes'] ?? '');
        $valor_total = isset($data['valor_total']) ? (float)$data['valor_total'] : 0.0;
        $id = isset($data['id']) ? (int)$data['id'] : null;
        
        // Se não tiver número OS e for criação, gera automaticamente
        if (empty($numero_os) && $id === null) {
            $repo = new ServiceOrderRepository();
            $numero_os = $repo->generateNumeroOS();
        }
        
        return new ServiceOrder(
            $id,
            $client_id,
            $numero_os ?: null,
            $tipo_servico,
            $data_abertura,
            $status,
            $descricao_problema,
            $descricao_servico ?: null,
            $observacoes ?: null,
            $valor_total
        );
    }
}

