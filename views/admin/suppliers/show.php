<?php $this->layout('layouts/admin', ['title' => 'Detalhe do Fornecedor']) ?>

<?php $this->start('body') ?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Detalhes do Fornecedor</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label class="form-label"><strong>ID:</strong></label>
                    <input type="text" class="form-control" value="<?= $this->e($supplier['id']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Nome da Empresa:</strong></label>
                    <input type="text" class="form-control" value="<?= $this->e($supplier['name']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>CNPJ:</strong></label>
                    <input type="text" class="form-control"
                           value="<?= $this->e($supplier['cnpj']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>E-mail:</strong></label>
                    <input type="text" class="form-control"
                           value="<?= $this->e($supplier['email']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Telefone:</strong></label>
                    <input type="text" class="form-control"
                           value="<?= $this->e($supplier['telefone']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Endereço:</strong></label>
                    <input type="text" class="form-control"
                           value="<?= $this->e($supplier['endereco']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Criado em:</strong></label>
                    <input type="text" class="form-control" value="<?= $this->e($supplier['created_at'] ?? '') ?>"
                           readonly>
                </div>
                <div class="text-end">
                    <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->stop() ?>

