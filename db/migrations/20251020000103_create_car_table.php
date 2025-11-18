<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCarTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('car');
        $table->addColumn('Marca', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('Modelo', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
              ->addColumn('updated_at', 'timestamp', ['null' => true, 'update' => 'CURRENT_TIMESTAMP'])
              ->create();
    }
}
