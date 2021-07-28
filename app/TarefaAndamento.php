<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TarefaAndamento extends Model
{
    public function DiasParaOFimTarefa($id){

        $tarefa = Tarefa::find($id);

        $fim =Carbon::parse($tarefa->data_fim_previsto);

        $hoje = Carbon::parse(Carbon::today());

        $dias = $hoje->diffInDays($fim, false);

         return $dias;

    }

    public function DefineStatusTarefa($id){

        $status = $this->DiasParaOFimTarefa($id);

        if ($status <0 ):
            return  "true";
        else:
            return  "none";
        endif;

    }

    public function DiasTotalTarefa($id){

        $tarefa = Tarefa::find($id);

        $fim =Carbon::parse($tarefa->data_fim_previsto);

        $inicio =Carbon::parse($tarefa->data_inicio_previsto);

        $diasTotal = $inicio->diffInDays($fim, false);

         return $diasTotal;

    }
}
