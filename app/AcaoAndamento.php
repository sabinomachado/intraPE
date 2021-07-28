<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use app\Acao;


class AcaoAndamento extends Model
{
   
    public function DiasTotaisAcao($id){

        $acao = Acao::find($id);

        $fim =Carbon::parse($acao->data_fim_previsto);

        $inicio = Carbon::parse($acao->data_inicio_previsto);

        $total_dia = $inicio->diffInDays($fim);


       return $total_dia;

    }

    public function CalculaPorcentagemAcao($id){

        $acao = Acao::find($id);
        $tarefas = $acao->tarefas()->get();
        $media = 0;
        $divisor = 0;
        $totalDiasPrevistos = 0;
        $totalDiasTrabalhados = 0;

        foreach ($tarefas as $tarefa) {
             $inicio = Carbon::parse($tarefa->data_inicio_previsto);
             $fim = Carbon::parse($tarefa->data_fim_previsto);
             $andamento = $tarefa->andamento;

             $dias_previstos =  $fim->diffInDays($inicio);
             if ($dias_previstos == 0){
                 $dias_previstos = 1;
                $dias_trabalhados = ($dias_previstos * ($andamento/100));
            }
                
            else{
                $dias_trabalhados = ($dias_previstos * ($andamento/100));
            }
             
             

             $divisor ++;

             $totalDiasPrevistos += $dias_previstos ;
             $totalDiasTrabalhados += $dias_trabalhados ;
            
        }
        if ($divisor == 0)
            $media = 0;
       
        else
            $media = number_format(($totalDiasTrabalhados / $totalDiasPrevistos) * 100, 2);

        

        return $media;
    }

    public function VerificaDependenteAcao($id){

        $acao = Acao::find($id);
        $tarefas = $acao->tarefas()->get();
        $dependentes =0;

            foreach ($tarefas as $tarefa) {

                $dependentes ++;

            }

         return $dependentes;

    }

    public function DiasParaOFimAcao($id){

        $acao = Acao::find($id);

        $fim =Carbon::parse($acao->data_fim_previsto);

        $hoje = Carbon::parse(Carbon::today());

        $dias = $hoje->diffInDays($fim, false);

         return $dias;

    }

    public function DefineStatusAcao($id){

        $acao = Acao::find($id);

        $dias_restante = $this->DiasParaOFimAcao($id);
        /*retorna quantos dias falta para o fim da ação*/

        $porcentagem = $this->CalculaPorcentagemAcao($id);
        /*retorna a média da porcentagem das tarefas referente a ação*/

        $fim =Carbon::parse($acao->data_fim_previsto);

        $inicio = Carbon::parse($acao->data_inicio_previsto);

        $hoje = Carbon::parse(Carbon::today());

        $dias_totais = $inicio->diffInDays($fim, false);
        /*retorna a quantidade de de dias corrido da ação*/

         if ($dias_restante <=0 ):
            return  "red";
        elseif ($dias_restante<=($dias_totais*0.6) && $porcentagem<=70 ):
            return  "yellow";
        elseif ($dias_restante<=($dias_totais*0.7) && $porcentagem<=80 ):
            return  "orange";
        elseif($dias_restante<=($dias_totais*0.8) && $porcentagem<=85 ):
            return  "red";
        elseif ($porcentagem == 100 ):
            return  "green";
        else:
            return  "blue";
        endif;

    }

    public function DefineTeste($id){

        $acao = Acao::find($id);

        $inicio = Carbon::parse($acao->data_inicio_previsto);

        $hoje = Carbon::parse(Carbon::today());

        $diasresult2 = $inicio->diffInDays($hoje, false);
        /*retorna a quantidade de de dias corrido da ação*/


        return $diasresult2;

    }

    public function ValorRealizadoAcao($id){

        $acao = Acao::find($id);
        $tarefas = $acao->tarefas()->sum('custo');
        $realizado = $tarefas;
      
        return $realizado;

    }

    public function DefineValorAcao($id){

        $acao = Acao::find($id);
            
         if ($acao->valor > $acao->custo):
            return  "valorSuperior";
        else:
            return  "table-default";
        endif;

    }

}
