<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Acao;
use App\AndamentoMeta;
use App\Tarefa;
use App\PerspectivaAndamento;
use App\ObjetivoAndamento;
use app\User;

class Objetivo extends ObjetivoAndamento
{
    protected $table = 'objetivos';

    protected $fillable = [ 
        'descricao', 'perspectiva_id', 'custo_objetivo', 'data_inicio', 'data_fim'
    ];

    protected $primaryKey = 'objetivo_id';

    public function perspectivas (){

        return $this->belongsTo(Perspectiva::class, 'perspectiva_id', 'perspectiva_id');

    }

    public function metas (){

        return $this->hasMany(Meta::class, 'objetivo_id', 'objetivo_id');

    }

    public function objetivoAndamento (){

        return $this->belongsTo(ObjetivoAndamento::class, 'objetivo_id','objetivo_id');

    }

    public function getObjetivoIdAttribute()
    {
        return $this->attributes['objetivo_id'];
    }

    public function getValorAttribute(){
       
        $realizado = $this->ValorRealizadoObjetivo($this->getObjetivoIdAttribute());
        
        return $realizado;
    }
    public function getTabelaObjetivoAttribute(){

        $tabela = $this->DefineValorObjetivo($this->getObjetivoIdAttribute());

        return $tabela;
    }

}
