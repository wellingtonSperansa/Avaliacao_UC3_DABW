<?php $this->layout('layouts/admin', ['title' => 'Detalhe do Carro']) ?>

<?php $this->start('body') ?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Detalhes do Carro</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label class="form-label"><strong>ID:</strong></label>
                    <input type="text" class="form-control" value="<?= $this->e($car['id']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Marca:</strong></label>
                    <input type="text" class="form-control" value="<?= $this->e($car['Marca']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Modelo:</strong></label>
                    <input type="text" class="form-control"
                           value="<?= $this->e($car['Modelo']) ?>" readonly>
                </div>
                <div class="text-end">
                    <a href="javascript:history.back()" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->stop() ?>
