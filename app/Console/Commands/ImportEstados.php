<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportEstados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:estados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa el archivo estados.sql con los estados de México';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return DB::unprepared(file_get_contents('database/migrations/estados.sql'));
    }
}
