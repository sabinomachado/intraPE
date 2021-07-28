<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Acao;
use App\AndamentoMeta;
use App\Tarefa;
use App\PerspectivaAndamento;
use App\ObjetivoAndamento;

class Perspectiva extends PerspectivaAndamento
{
    protected $fillable = [
        'perspectiva_id','titulo','descricao'
    ];

    protected $table = "perspectivas";

    protected $primaryKey = 'perspectiva_id';


/*      public $timestamps = false; */

    public function objetivos (){

        return $this->hasMany(Objetivo::class, 'perspectiva_id', 'perspectiva_id');

    }

    public function perspectivaAndamento (){

        return $this->belongsTo(PerspectivaAndamento::class, 'perspectiva_id','perspectiva_id');
    }


}
