<?php $this->layout('layouts/admin', ['title' => 'Fornecedores']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm" id="tableView">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">Lista de Fornecedores</h5>
        <a href="/admin/suppliers/create" class="btn btn-primary" id="btnNewUser">
            <i class="bi bi-plus-lg"></i> Novo Fornecedor
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($suppliers as $supplier): ?>
                    <tr>
                        <td><?= $this->e($supplier['id']) ?></td>
                        <td><?= $this->e($supplier['name']) ?></td>
                        <td><?= $this->e($supplier['cnpj']) ?></td>
                        <td><?= $this->e($supplier['email']) ?></td>
                        <td><?= $this->e($supplier['telefone']) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a class="btn btn-sm btn-secondary btn-edit"
                                   href="/admin/suppliers/show?id=<?= $this->e($supplier['id']) ?>">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                                <a class="btn btn-sm btn-primary btn-edit"
                                    href="/admin/suppliers/edit?id=<?= $this->e($supplier['id']) ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form class="inline" action="/admin/suppliers/delete" method="post"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este fornecedor? (<?= $this->e($supplier['name']) ?>)');">
                                    <input type="hidden" name="id" value="<?= $this->e($supplier['id']) ?>">
                                    <?= \App\Core\Csrf::input() ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pagination" style="margin-top:12px;">
    <?php for ($i = 1; $i <= $pages; $i++): ?>
        <?php if ($i == $page): ?>
            <strong>[<?= $i ?>]</strong>
        <?php else: ?>
            <a href="/admin/suppliers?page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</div>

<?php $this->stop() ?>

