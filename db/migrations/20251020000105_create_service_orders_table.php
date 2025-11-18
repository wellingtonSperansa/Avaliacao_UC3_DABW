<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateServiceOrdersTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('service_orders')
            ->addColumn('client_id', 'integer', ['signed' => false])
            ->addColumn('numero_os', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('tipo_servico', 'string', ['limit' => 50])
            ->addColumn('data_abertura', 'date')
            ->addColumn('status', 'string', ['limit' => 20, 'default' => 'aberta'])
            ->addColumn('descricao_problema', 'text')
            ->addColumn('descricao_servico', 'text', ['null' => true])
            ->addColumn('observacoes', 'text', ['null' => true])
            ->addColumn('valor_total', 'decimal', ['precision' => 10, 'scale' => 2, 'default' => 0])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'update' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('client_id', 'clients', 'id', ['delete' => 'NO ACTION', 'update' => 'NO ACTION'])
            ->create();
    }
}

