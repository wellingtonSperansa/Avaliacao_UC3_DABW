<?php

namespace App\Models;

class ServiceOrder
{
    public ?int $id;
    public int $client_id;
    public ?string $numero_os;
    public string $tipo_servico;
    public string $data_abertura;
    public string $status;
    public string $descricao_problema;
    public ?string $descricao_servico;
    public ?string $observacoes;
    public float $valor_total;

    public function __construct(
        ?int $id,
        int $client_id,
        ?string $numero_os,
        string $tipo_servico,
        string $data_abertura,
        string $status,
        string $descricao_problema,
        ?string $descricao_servico,
        ?string $observacoes,
        float $valor_total
    ) {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->numero_os = $numero_os;
        $this->tipo_servico = $tipo_servico;
        $this->data_abertura = $data_abertura;
        $this->status = $status;
        $this->descricao_problema = $descricao_problema;
        $this->descricao_servico = $descricao_servico;
        $this->observacoes = $observacoes;
        $this->valor_total = $valor_total;
    }
}

