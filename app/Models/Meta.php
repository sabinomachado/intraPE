<?php

namespace App\Models;

use App\Acao;
use App\AndamentoMeta;
use App\Tarefa;
use App\MetaAndamento;
use App\User;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;

class Meta extends MetaAndamento
{

    protected $table = 'metas';

    protected $fillable = [
        'titulo', 'descricao', 'data_inicio_previsto', 'data_fim_previsto','data_inicio_real', 'data_fim_real','custo','andamento','objetivo_id', 'usuario_login'
    ];

    protected $primaryKey = 'meta_id';

    public function objetivos (){

        return $this->belongsTo(Objetivo::class, 'objetivo_id','objetivo_id');

    }

    public function metaAndamento (){

        return $this->belongsTo(MetaAndamento::class, 'meta_id','meta_id');

    }

    public function acoes(){

        return $this->hasMany(Acao::class, 'meta_id', 'meta_id');
}

    public function tarefas(){

        return $this->hasMany(Tarefa::class, 'acao_id', 'acao_id');
    }

    public function usuarios(){

        return $this->belongsTo(User::class, 'usuario_login', 'login');
    }

    public function getMetaIdAttribute()
    {
        return $this->attributes['meta_id'];
    }

    public function getDiasTotalAttribute()
    {
        $diastotal = $this->DiasTotaisMeta($this->getMetaIdAttribute());
        return $diastotal;
    }

    public function getDiasFimAttribute()
    {
        $diasfim = $this->DiasParaOFimMeta($this->getMetaIdAttribute());
        return $diasfim;
    }

    public function getMediaAttribute(){

        $media = $this->PorcentagemMeta($this->getMetaIdAttribute());
        return $media;
    }

    public function getDependentesAttribute(){

        $divisor = $this->PegaAcao($this->getMetaIdAttribute());
        return $divisor;
    }

    public function getValorAttribute(){
       
        $realizado = $this->ValorRealizadoMeta($this->getMetaIdAttribute());
        
        return $realizado;
    }

    public function getTabelaMetaAttribute(){

        $tabela = $this->DefineValorMeta($this->getMetaIdAttribute());

        return $tabela;
    }
}

