<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'regionais';

    protected $fillable = ['id', 'label'];

    public function clinicas()
    {
        return $this->hasMany(Clinica::class);
    }
}
