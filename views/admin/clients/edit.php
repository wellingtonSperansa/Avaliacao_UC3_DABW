<?php $this->layout('layouts/admin', ['title' => 'Editar Cliente']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm" id="formView">
    <?php $this->insert('partials/admin/form/header', ['title' => 'Editar Cliente']) ?>
    <div class="card-body">
        <form method="post" action="/admin/clients/update" enctype="multipart/form-data" class="">
            <input type="hidden" name="id" value="<?= $this->e($client['id']) ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome"
                           value="<?= $this->e(($client['name'] ?? '')) ?>" required>
                    <?php if (!empty($errors['name'])): ?>
                        <div class="text-danger"><?= $this->e($errors['name']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="text" class="form-label">Texto</label>
                    <input type="text" class="form-control" id="sobre_nome" name="sobre_nome"
                           placeholder="Digite o sobrenome" value="<?= $this->e(($client['sobre_nome'] ?? '')) ?>">
                    <?php if (!empty($errors['sobre_nome'])): ?>
                        <div class="text-danger"><?= $this->e($errors['sobre_nome']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="Digite o e-mail" value="<?= $this->e(($client['email'] ?? '')) ?>">
                    <?php if (!empty($errors['email'])): ?>
                        <div class="text-danger"><?= $this->e($errors['email']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone"
                           placeholder="Digite o telefone" value="<?= $this->e(($client['telefone'] ?? '')) ?>">
                    <?php if (!empty($errors['telefone'])): ?>
                        <div class="text-danger"><?= $this->e($errors['telefone']) ?></div><?php endif; ?>
                </div>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Atualizar
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Limpar
                </button>
                <a href="/admin/clients/index" class="btn align-self-end">
                    <i class="bi bi-x-lg"></i> Cancelar
                </a>
            </div>
            <?= \App\Core\Csrf::input() ?>
        </form>
    </div>
</div>

<?php $this->stop() ?>
