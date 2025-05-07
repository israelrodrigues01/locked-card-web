<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature = 'backup:db';
    protected $description = 'Gera um backup do banco de dados e salva como .sql na raiz do projeto';

    public function handle()
    {
        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $backupPath = base_path("backup-" . date('Y-m-d_H-i-s') . ".sql");

        $command = "mysqldump -h {$dbHost} -P {$dbPort} -u {$dbUser}";

        // adiciona senha se existir
        if (!empty($dbPass)) {
            $command .= " -p\"{$dbPass}\"";
        }

        $command .= " {$dbName} > {$backupPath}";

        $this->info("Executando backup...");

        $result = null;
        system($command, $result);

        if ($result === 0) {
            $this->info("Backup criado com sucesso: {$backupPath}");
        } else {
            $this->error("Falha ao criar backup.");
        }
    }
}
