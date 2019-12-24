<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convidado extends Model
{
    /**
     * Declaração do nome da tabela.
     */
    protected $table = 'convidado';

    protected $fillable = [
        'id', 'ativo', 'nome', 'idFamilia', 'confirmado', 
    ];
}
