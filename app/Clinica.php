<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Clinica extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';
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

    protected $table = 'clinicas';

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class, 'clinica_especialidade');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Uuid::uuid4()->toString();
            }
        });
    }
}
