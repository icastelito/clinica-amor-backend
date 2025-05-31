<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'nome'];

    public function clinicas()
    {
        return $this->belongsToMany(Clinica::class, 'clinica_especialidade');
    }
}
