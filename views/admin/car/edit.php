<?php $this->layout('layouts/admin', ['title' => 'Editar Carro']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm" id="formView">
    <?php $this->insert('partials/admin/form/header', ['title' => 'Editar Carro']) ?>
    <div class="card-body">
        <form method="post" action="/admin/cars/update" enctype="multipart/form-data" class="">
            <input type="hidden" name="id" value="<?= $this->e($car['id']) ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Marca" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="Marca" name="Marca" placeholder="Digite a marca"
                           value="<?= $this->e(($car['Marca'] ?? '')) ?>" required>
                    <?php if (!empty($errors['Marca'])): ?>
                        <div class="text-danger"><?= $this->e($errors['Marca']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="Modelo" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="Modelo" name="Modelo"
                           placeholder="Digite o modelo" value="<?= $this->e(($car['Modelo'] ?? '')) ?>">
                    <?php if (!empty($errors['Modelo'])): ?>
                        <div class="text-danger"><?= $this->e($errors['Modelo']) ?></div><?php endif; ?>
                </div>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Atualizar
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Limpar
                </button>
                <a href="/admin/cars" class="btn align-self-end">
                    <i class="bi bi-x-lg"></i> Cancelar
                </a>
            </div>
            <?= \App\Core\Csrf::input() ?>
        </form>
    </div>
</div>

<?php $this->stop() ?>
