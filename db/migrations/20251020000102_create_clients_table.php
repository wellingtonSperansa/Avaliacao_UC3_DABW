<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateClientsTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('clients')
            ->addColumn('name', 'string', ['limit' => 50])
            ->addColumn('sobre_nome', 'string', ['limit' => 50])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('telefone', 'string', ['limit' => 15])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
