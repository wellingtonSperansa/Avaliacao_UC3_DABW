<?php $this->layout('layouts/admin', ['title' => 'Detalhe da Ordem de Serviço']) ?>

<?php $this->start('body') ?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Detalhes da Ordem de Serviço</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label"><strong>ID:</strong></label>
                        <input type="text" class="form-control" value="<?= $this->e($serviceOrder['id']) ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label"><strong>Nº OS:</strong></label>
                        <input type="text" class="form-control" value="<?= $this->e($serviceOrder['numero_os'] ?? '-') ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label"><strong>Data de Abertura:</strong></label>
                        <input type="text" class="form-control" value="<?= date('d/m/Y', strtotime($serviceOrder['data_abertura'])) ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label"><strong>Status:</strong></label>
                        <?php
                        $statusClass = match($serviceOrder['status']) {
                            'aberta' => 'badge bg-warning',
                            'em_andamento' => 'badge bg-info',
                            'aguardando_pecas' => 'badge bg-secondary',
                            'concluida' => 'badge bg-success',
                            'cancelada' => 'badge bg-danger',
                            default => 'badge bg-secondary'
                        };
                        $statusLabel = ucfirst(str_replace('_', ' ', $serviceOrder['status']));
                        ?>
                        <div class="mt-2">
                            <span class="<?= $statusClass ?> fs-6"><?= $statusLabel ?></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Cliente:</strong></label>
                        <input type="text" class="form-control" value="<?= $this->e($serviceOrder['client_name'] ?? 'Cliente não encontrado') ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label"><strong>E-mail:</strong></label>
                        <input type="text" class="form-control" value="<?= $this->e($serviceOrder['client_email'] ?? '-') ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label"><strong>Telefone:</strong></label>
                        <input type="text" class="form-control" value="<?= $this->e($serviceOrder['client_telefone'] ?? '-') ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Tipo de Serviço:</strong></label>
                        <input type="text" class="form-control" value="<?= ucfirst($this->e($serviceOrder['tipo_servico'])) ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Valor Total:</strong></label>
                        <input type="text" class="form-control" value="R$ <?= number_format($serviceOrder['valor_total'], 2, ',', '.') ?>" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label"><strong>Descrição do Problema:</strong></label>
                        <textarea class="form-control" rows="3" readonly><?= $this->e($serviceOrder['descricao_problema']) ?></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label"><strong>Descrição do Serviço:</strong></label>
                        <textarea class="form-control" rows="3" readonly><?= $this->e($serviceOrder['descricao_servico'] ?? '-') ?></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label"><strong>Observações:</strong></label>
                        <textarea class="form-control" rows="2" readonly><?= $this->e($serviceOrder['observacoes'] ?? '-') ?></textarea>
                    </div>
                </div>
                <div class="text-end">
                    <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->stop() ?>

