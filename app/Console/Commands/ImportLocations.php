<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\LocationsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportLocations extends Command
{
    protected $signature = 'import:locations';
    protected $description = 'Import all locations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Excel::import(new LocationsImport, 'storage/imports/20codmun.xlsx');

        $this->info('Excel imported to database!.');
    }
}
