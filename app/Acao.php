<?php

namespace App;

use App\Models\Meta;
use App\Tarefa;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;



class Acao extends AcaoAndamento
{
    protected $table = 'acoes';

    protected $fillable = [
        'descricao', 'data_inicio_previsto', 'data_fim_previsto','data_inicio_real', 'data_fim_real','andamento','meta_id', 'usuario_login', 'custo'
    ];

    protected $primaryKey = 'acao_id';

    public function metas(){

        return $this->belongsTo(Meta::class, 'meta_id','meta_id');
    }

    public function tarefas(){

        return $this->hasMany(Tarefa::class, 'acao_id', 'acao_id');
    }

    public function usuarios(){

        return $this->belongsTo(User::class,'usuario_login', 'login');
    }

    public function getMediaAttribute()
    {
        $media = $this->CalculaPorcentagemAcao($this->getAcaoIdAttribute());

        return $media;
    }

    public function getAcaoIdAttribute()
    {
        return $this->attributes['acao_id'];
    }

    public function getDiasFimAttribute()
    {
        $diasfim = $this->DiasParaOFimAcao($this->getAcaoIdAttribute());

        return $diasfim;
    }

    public function getDiasTotalAttribute()
    {
        $diastotal = $this->DiasTotaisAcao($this->getAcaoIdAttribute());

        return $diastotal;
    }

    public function getCorAttribute()
    {
        $cor = $this->DefineStatusAcao($this->getAcaoIdAttribute());

        return $cor;
    }

    public function getValorAttribute(){

        $realizado = $this->ValorRealizadoAcao($this->getAcaoIdAttribute());

        return $realizado;
    }

    public function getTabelaAcaoAttribute(){

        $tabela = $this->DefineValorAcao($this->getAcaoIdAttribute());

        return $tabela;
    }


}
