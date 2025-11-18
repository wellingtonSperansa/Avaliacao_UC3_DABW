<?php $this->layout('layouts/admin', ['title' => 'Novo Fornecedor']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm" id="formView">
    <?php $this->insert('partials/admin/form/header', ['title' => 'Novo Fornecedor']) ?>
    <div class="card-body">
        <form method="post" action="/admin/suppliers/store" enctype="multipart/form-data" class="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nome da Empresa</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome da empresa"
                           value="<?= $this->e(($old['name'] ?? '')) ?>">
                    <?php if (!empty($errors['name'])): ?>
                        <div class="text-danger"><?= $this->e($errors['name']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cnpj" class="form-label">CNPJ</label>
                    <input type="text" class="form-control" id="cnpj" name="cnpj"
                           placeholder="00.000.000/0000-00" value="<?= $this->e(($old['cnpj'] ?? '')) ?>">
                    <?php if (!empty($errors['cnpj'])): ?>
                        <div class="text-danger"><?= $this->e($errors['cnpj']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="Digite o e-mail" value="<?= $this->e(($old['email'] ?? '')) ?>">
                    <?php if (!empty($errors['email'])): ?>
                        <div class="text-danger"><?= $this->e($errors['email']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone"
                           placeholder="(00) 00000-0000" value="<?= $this->e(($old['telefone'] ?? '')) ?>">
                    <?php if (!empty($errors['telefone'])): ?>
                        <div class="text-danger"><?= $this->e($errors['telefone']) ?></div><?php endif; ?>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco"
                           placeholder="Digite o endereço completo" value="<?= $this->e(($old['endereco'] ?? '')) ?>">
                    <?php if (!empty($errors['endereco'])): ?>
                        <div class="text-danger"><?= $this->e($errors['endereco']) ?></div><?php endif; ?>
                </div>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg"></i> Salvar
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Limpar
                </button>
                <a href="/admin/suppliers" class="btn align-self-end">
                    <i class="bi bi-x-lg"></i> Cancelar
                </a>
            </div>
            <?= \App\Core\Csrf::input() ?>
        </form>
    </div>
</div>
<?php $this->stop() ?>

