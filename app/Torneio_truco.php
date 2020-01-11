<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Torneio_truco extends Model
{
    /**
     * Declaração do nome da tabela.
     */
    protected $table = 'torneio_truco';

    protected $fillable = [
        'id', 'nomeDupla', 'idParticipante1', 'idParticipante2', 'adminDupla', 'ativo'
    ];
    
}
