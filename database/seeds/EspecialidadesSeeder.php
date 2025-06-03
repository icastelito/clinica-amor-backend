<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class EspecialidadesSeeder extends Seeder
{

    public function run()
    {
        $especialidades = [
            'Cardiologia',
            'Dermatologia',
            'Ginecologia',
            'Pediatria',
            'Ortopedia',
            'Neurologia',
            'Psiquiatria',
            'Oftalmologia',
            'Endocrinologia',
            'Urologia',
            'Gastroenterologia',
            'Reumatologia',
            'Otorrinolaringologia',
            'Oncologia',
            'Infectologia',
            'Nefrologia',
            'Hematologia',
            'Pneumologia',
            'Geriatria',
            'Genética Médica',
            'Medicina do Trabalho',
            'Medicina Esportiva',
            'Medicina de Família e Comunidade',
            'Medicina Preventiva',
            'Clínica Geral',
            'Medicina Intensiva',
            'Medicina de Emergência',
        ];

        foreach ($especialidades as $label) {
            DB::table('especialidades')->insert([
                'id' => Uuid::uuid4()->toString(),
                'nome' => $label,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
