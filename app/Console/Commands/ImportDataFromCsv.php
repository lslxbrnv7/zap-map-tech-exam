<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Location;

class ImportDataFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-data-from-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports Data to DB from a CSV file.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fileName = 'data.csv';
        $filePath = '/uploads/'.$fileName;

        if (!Storage::exists($filePath)) {
            $this->error('The specified file does not exist.');
            return 0;
        }
        $file = Storage::get($filePath);
        $array = array_map("str_getcsv", explode("\n", $file));

        Location::exists() ? Location::truncate() : null;

        foreach($array as $data)
        {
            Location::create([
                'name' => $data[0],
                'longitude' => $data[1],
                'latitude' => $data[2]
            ]);
            $this->info($data[0] . ' created!');
        }

        $this->info('Data has been imported!');
    }
}
