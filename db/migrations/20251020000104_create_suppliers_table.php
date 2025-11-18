<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSuppliersTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('suppliers')
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('cnpj', 'string', ['limit' => 18])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('telefone', 'string', ['limit' => 15])
            ->addColumn('endereco', 'string', ['limit' => 200])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}

