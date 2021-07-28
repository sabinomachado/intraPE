<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Acao;
use Carbon\Carbon;
use App\User;

class Tarefa extends TarefaAndamento
{
    protected $table = 'tarefas';

    protected $fillable = [
        'descricao', 'data_inicio_previsto', 'data_fim_previsto','data_inicio_real', 'data_fim_real','andamento','acao_id', 'usuario_login', 'custo'
    ];

    protected $primaryKey = 'tarefa_id';

    public function acoes(){

        return $this->belongsTo(Acao::class, 'acao_id', 'acao_id');
    }

    public function usuarios(){

        return $this->belongsTo(User::class,'usuario_login', 'login');
    }

    public function getTarefaIdAttribute()
    {
        return $this->attributes['tarefa_id'];
    }

    public function getDiasFimAttribute()
    {
        $diasfim = $this->DiasParaOFimTarefa($this->getTarefaIdAttribute());

        return $diasfim;
    }
    public function getStatusAttribute()
    {
        $status = $this->DefineStatusTarefa($this->getTarefaIdAttribute());

        return $status;
    }

    public function getDiasTotalAttribute()
    {
        $diasTotal = $this->DiasTotalTarefa($this->getTarefaIdAttribute());

        return $diasTotal;
    }

}
