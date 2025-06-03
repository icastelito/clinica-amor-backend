<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RegionaisSeeder::class);
        $this->call(EspecialidadesSeeder::class);
    }
}
