<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use app\Models\Meta;

class MetaAndamento extends Model
{
    protected $table = 'vw_meta';

    protected $fillable = ['meta_id', 'andamento'];



    public function ValorRealizadoMeta($id){

        $meta = Meta::find($id);
        $acoes = $meta->acoes()->get();        

        $realizado = 0;
       
            foreach($acoes as $acao) {
                /*    
                $acaoId = $acao->acao_id;
            
                $tarefa = Tarefa::where('acao_id', '=', $acaoId)->sum('custo');*/
                $realizado += $acao->valor;
                
            } 
       
        return $realizado;

    }
        
    public function DefineValorMeta($id){

        $meta = Meta::find($id);
       /*  $metaId = $acao->meta_id;

        $meta = Meta::where('meta_id','=', $metaId)->first(); */
        
         if ($meta->valor > $meta->custo):
            return  "valorSuperior";
        else:
            return  "table-default";
        endif;

    }


}




