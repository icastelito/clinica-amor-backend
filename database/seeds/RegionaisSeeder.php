<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class RegionaisSeeder extends Seeder
{

    public function run()
    {
        $regionais = [
            'Alto tietê',
            'Interior',
            'ES',
            'SP Interior',
            'SP',
            'SP2',
            'MG',
            'Nacional',
            'SP CAV',
            'RJ',
            'SP1',
            'NE1',
            'NE2',
            'SUL',
            'Norte',
        ];

        foreach ($regionais as $label) {
            DB::table('regionais')->insert([
                'id' => Uuid::uuid4()->toString(),
                'nome' => $label,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
