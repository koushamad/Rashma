<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('sql/');
        collect(scandir($path))->filter(function ($file){
            return $file != '.' && $file != '..';
        })->each(function ($file) use($path){
            DB::unprepared(file_get_contents($path . $file));
            $this->command->info('Run SQL ' . $file);
        });

        $this->command->info('Finish All SQL Files');
    }
}
