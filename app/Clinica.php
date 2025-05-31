<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'regional_id',
        'data_inauguracao',
        'ativa'
    ];

    protected $casts = [
        'ativa' => 'boolean',
        'data_inauguracao' => 'date',
    ];

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class, 'clinica_especialidade');
    }
}
