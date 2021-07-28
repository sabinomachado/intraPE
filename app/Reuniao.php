<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reuniao extends Model
{
    protected $table = 'reunioes';

    protected $fillable = [
        'titulo','descricao', 'data', 'hora_inicio'
    ];

    protected $primaryKey = 'reuniao_id';


}
