<?php

namespace App;

use App\Models\Objetivo;

use Illuminate\Database\Eloquent\Model;

class ObjetivoAndamento extends Model
{
    protected $table = 'vw_objetivo';

    protected $fillable = ['objetivo_id', 'andamento'];

    public function ValorRealizadoObjetivo($id){
        $objetivo = Objetivo::find($id);
        $metas = $objetivo->metas()->get();
        
        $realizado = 0;
       
            foreach($metas as $meta) {
                    
                //$metaId = $meta->meta_id;
            
                //pegar ação e depois tarefa

                
            
                //$tarefa = Tarefa::where('acao_id', '=', $acaoId)->sum('custo');
                $realizado += $meta->valor;
                
            } 
       
        return $realizado;

    }

    public function DefineValorObjetivo($id){

        $objetivo = Objetivo::find($id);
      
         if ($objetivo->valor > $objetivo->custo):
            return  "valorSuperior";
        else:
            return  "table-default";
        endif;

    }
}
