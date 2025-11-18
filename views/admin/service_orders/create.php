<?php $this->layout('layouts/admin', ['title' => 'Nova Ordem de Serviço']) ?>

<?php $this->start('body') ?>
<div class="card shadow-sm" id="formView">
    <?php $this->insert('partials/admin/form/header', ['title' => 'Nova Ordem de Serviço']) ?>
    <div class="card-body">
        <form method="post" action="/admin/service-orders/store" enctype="multipart/form-data" class="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="client_id" class="form-label">Cliente <span class="text-danger">*</span></label>
                    <select class="form-select" id="client_id" name="client_id" required>
                        <option value="">Selecione um cliente</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $this->e($client['id']) ?>" 
                                <?= (isset($old['client_id']) && $old['client_id'] == $client['id']) ? 'selected' : '' ?>>
                                <?= $this->e($client['name'] . ' ' . ($client['sobre_nome'] ?? '')) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['client_id'])): ?>
                        <div class="text-danger"><?= $this->e($errors['client_id']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="tipo_servico" class="form-label">Tipo de Serviço <span class="text-danger">*</span></label>
                    <select class="form-select" id="tipo_servico" name="tipo_servico" required>
                        <option value="">Selecione</option>
                        <option value="manutencao" <?= (isset($old['tipo_servico']) && $old['tipo_servico'] == 'manutencao') ? 'selected' : '' ?>>Manutenção</option>
                        <option value="reparo" <?= (isset($old['tipo_servico']) && $old['tipo_servico'] == 'reparo') ? 'selected' : '' ?>>Reparo</option>
                        <option value="instalacao" <?= (isset($old['tipo_servico']) && $old['tipo_servico'] == 'instalacao') ? 'selected' : '' ?>>Instalação</option>
                        <option value="revisao" <?= (isset($old['tipo_servico']) && $old['tipo_servico'] == 'revisao') ? 'selected' : '' ?>>Revisão</option>
                    </select>
                    <?php if (!empty($errors['tipo_servico'])): ?>
                        <div class="text-danger"><?= $this->e($errors['tipo_servico']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="data_abertura" class="form-label">Data de Abertura <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="data_abertura" name="data_abertura" 
                           value="<?= $this->e(($old['data_abertura'] ?? date('Y-m-d'))) ?>" required>
                    <?php if (!empty($errors['data_abertura'])): ?>
                        <div class="text-danger"><?= $this->e($errors['data_abertura']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="aberta" <?= (isset($old['status']) && $old['status'] == 'aberta') ? 'selected' : 'selected' ?>>Aberta</option>
                        <option value="em_andamento" <?= (isset($old['status']) && $old['status'] == 'em_andamento') ? 'selected' : '' ?>>Em Andamento</option>
                        <option value="aguardando_pecas" <?= (isset($old['status']) && $old['status'] == 'aguardando_pecas') ? 'selected' : '' ?>>Aguardando Peças</option>
                        <option value="concluida" <?= (isset($old['status']) && $old['status'] == 'concluida') ? 'selected' : '' ?>>Concluída</option>
                        <option value="cancelada" <?= (isset($old['status']) && $old['status'] == 'cancelada') ? 'selected' : '' ?>>Cancelada</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="valor_total" class="form-label">Valor Total</label>
                    <input type="number" step="0.01" class="form-control" id="valor_total" name="valor_total" 
                           placeholder="0.00" value="<?= $this->e(($old['valor_total'] ?? '0')) ?>">
                    <?php if (!empty($errors['valor_total'])): ?>
                        <div class="text-danger"><?= $this->e($errors['valor_total']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="descricao_problema" class="form-label">Descrição do Problema <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="descricao_problema" name="descricao_problema" rows="3" 
                              placeholder="Descreva o problema relatado pelo cliente" required><?= $this->e(($old['descricao_problema'] ?? '')) ?></textarea>
                    <?php if (!empty($errors['descricao_problema'])): ?>
                        <div class="text-danger"><?= $this->e($errors['descricao_problema']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="descricao_servico" class="form-label">Descrição do Serviço</label>
                    <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="3" 
                              placeholder="Descreva o serviço que será realizado"><?= $this->e(($old['descricao_servico'] ?? '')) ?></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="observacoes" class="form-label">Observações</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="2" 
                              placeholder="Observações adicionais"><?= $this->e(($old['observacoes'] ?? '')) ?></textarea>
                </div>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg"></i> Salvar
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i> Limpar
                </button>
                <a href="/admin/service-orders" class="btn align-self-end">
                    <i class="bi bi-x-lg"></i> Cancelar
                </a>
            </div>
            <?= \App\Core\Csrf::input() ?>
        </form>
    </div>
</div>
<?php $this->stop() ?>

