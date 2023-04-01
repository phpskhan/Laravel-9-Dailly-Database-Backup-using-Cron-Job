<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class DB_Bup_Cron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating Database Backup on Daily Basis';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $fileName = "DB-Backup-".Carbon::now()->format('Y-m-d').".gz";

        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password" . env('DB_PASSWORD') ." --host" . env('DB_HOST') . " " . env('DB_DATABASE') . " | gzip > " . storage_path() . "/app/backup/" . $fileName;

        $output = NULL;

        $returnVar = NULL;

        exec($command,$output,$returnVar);

    }
}
