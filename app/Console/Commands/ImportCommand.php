<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use App\Author;
use App\Book;
use App\Idea;
use App\Current;
use App\Quote;


class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:authors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Authors Data';

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
     * @return mixed
     */
    public function handle()
    {

        if ($this->confirm('Run this command remove all previous data. Do you wish to continue?')) {
            Artisan::call('migrate:refresh');
            $files = $this->files();
            foreach ($files as $filename => $model) {
                $this->import($this->read($filename), $model);
            }
        }

        $this->info('Import completed!');
    }

    public function import($file_data, $model)
    {
        extract($file_data);
        foreach ($data as $row) {
            $seed = [];
            if ($this->validate($keys, $row)) {
                $seed = array_combine($keys, $row);
                $this->name($model)::create($seed);
            }
        }
    }

    private function validate($keys, $row)
    {
        if (empty($row)) {
            return false;
        }
        if (count($keys) != count($row)) {
            return false;
        }
        return true;
    }

    private function name($model)
    {
        return "App\\" . $model;
    }

    public function read($filename)
    {
        $file = Storage::disk('data')->path($filename . '.csv');
        $file_handle = fopen($file, 'r');

        $data = [];
        while (!feof($file_handle)) {
            $data[] = fgetcsv($file_handle, 0, ',');
        }
        $keys = array_shift($data);

        return ['keys' => $keys, 'data' => $data];
    }

    public function files()
    {
        return [
            'boulesis_authors' => 'Author',
            'boulesis_books' => 'Book',
            'boulesis_currents' => 'Current',
            'boulesis_ideas' => 'Idea',
            'boulesis_quotes' => 'Quote'
        ];
    }
}
