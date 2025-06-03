<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Especialidade extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'especialidades';

    protected $fillable = ['id', 'nome'];

    public function clinicas()
    {
        return $this->belongsToMany(Clinica::class, 'clinica_especialidade');
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
