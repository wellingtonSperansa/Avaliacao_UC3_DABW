<?php $this->layout('layouts/admin', ['title' => 'Ordens de Serviço']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm" id="tableView">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-semibold">Lista de Ordens de Serviço</h5>
        <a href="/admin/service-orders/create" class="btn btn-primary" id="btnNewUser">
            <i class="bi bi-plus-lg"></i> Nova Ordem de Serviço
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nº OS</th>
                    <th>Cliente</th>
                    <th>Tipo Serviço</th>
                    <th>Data Abertura</th>
                    <th>Status</th>
                    <th>Valor Total</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($serviceOrders as $os): ?>
                    <tr>
                        <td><?= $this->e($os['id']) ?></td>
                        <td><?= $this->e($os['numero_os'] ?? '-') ?></td>
                        <td><?= $this->e($os['client_name'] ?? 'Cliente não encontrado') ?></td>
                        <td><?= $this->e($os['tipo_servico']) ?></td>
                        <td><?= date('d/m/Y', strtotime($os['data_abertura'])) ?></td>
                        <td>
                            <?php
                            $statusClass = match($os['status']) {
                                'aberta' => 'badge bg-warning',
                                'em_andamento' => 'badge bg-info',
                                'aguardando_pecas' => 'badge bg-secondary',
                                'concluida' => 'badge bg-success',
                                'cancelada' => 'badge bg-danger',
                                default => 'badge bg-secondary'
                            };
                            $statusLabel = ucfirst(str_replace('_', ' ', $os['status']));
                            ?>
                            <span class="<?= $statusClass ?>"><?= $statusLabel ?></span>
                        </td>
                        <td>R$ <?= number_format($os['valor_total'], 2, ',', '.') ?></td>
                        <td>
                            <div class="action-buttons">
                                <a class="btn btn-sm btn-secondary btn-edit"
                                   href="/admin/service-orders/show?id=<?= $this->e($os['id']) ?>">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                                <a class="btn btn-sm btn-primary btn-edit"
                                    href="/admin/service-orders/edit?id=<?= $this->e($os['id']) ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form class="inline" action="/admin/service-orders/delete" method="post"
                                      onsubmit="return confirm('Tem certeza que deseja excluir esta ordem de serviço? (<?= $this->e($os['numero_os'] ?? 'OS #' . $os['id']) ?>)');">
                                    <input type="hidden" name="id" value="<?= $this->e($os['id']) ?>">
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
            <a href="/admin/service-orders?page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</div>

<?php $this->stop() ?>

