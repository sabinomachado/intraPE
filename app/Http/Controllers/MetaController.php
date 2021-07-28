<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Models\Objetivo;
use App\Acao;
use App\Tarefa;
use Illuminate\Http\Request;
use App\User;
use DB;
use Validator;
use App\Rules\CustoMeta;
use App\Rules\ValidaInicioMeta;
use App\Rules\ValidaFimMeta;
use Illuminate\Support\Facades\Gate;

class MetaController extends Controller
{
    public function index()
    {
        $metas = Meta::all();



        return view('metas.index')->with(['metas' => $metas]);
    }


    public function create(Request $request)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {

            $objetivo = Objetivo::find($request->all());


            $usuarios = User::where('status', '=', 'ativo')->orderBy('nome')->get();


        return view('metas.create')->with(['objetivo' => $objetivo, 'usuarios' =>$usuarios]);
        }
        else{
            return redirect('/estrategico');
        }



    }


    public function store(Request $request)
    {

        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $request->validate([
                'titulo'=> 'required|max:45',
                'custo' => [new CustoMeta(),'required','numeric','min:0'],
                'descricao' => 'required|max:200',
                'data_inicio_previsto' => [new ValidaInicioMeta(), 'required','before_or_equal:data_fim_previsto'],
                'data_fim_previsto' => [new ValidaFimMeta(), 'required','after_or_equal:data_inicio_previsto'],
                'usuario_login' => 'required|not_in:' . "null|max:20"
            ]);

            Meta::create($request->all());

            $objetivo = Objetivo::find($request->objetivo_id);




            return redirect()->route('objetivos.show', ['objetivo'=> $objetivo]);
        }
        else{
            return redirect('/estrategico');
        }



    }


    public function show($id)
    {
        /*  $id = decrypt($id); */
       

        $meta = Meta::find($id);

        $objetivos = $meta->objetivos()->get();

        $acoes = $meta->acoes()->get();

      
        $realizado = 0;      
        $somaAcoes = 0;
        foreach($acoes as $acao){
            $somaAcoes += $acao->custo;
           
           
        }
      
        $disponivel = ($meta->custo - $somaAcoes);

      
        
        return view('metas.show') -> with(['meta' => $meta, 'objetivos' => $objetivos, 'acoes' => $acoes, 'somaAcoes' => $somaAcoes, 'disponivel' => $disponivel,'realizado' => $realizado]);
    }


    public function edit($id)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $meta = Meta::find($id);

        $objetivo = Objetivo::find($meta->objetivo_id);

        $usuarios = User::where('status', '=', 'ativo')->orderBy('nome')->get();

        $acoes = $meta->acoes()->get();

      

        return view('metas.edit')-> with(['meta' => $meta, 'objetivo' => $objetivo, 'usuarios' =>$usuarios]);
        }
        else{
            return redirect('/estrategico');
        }


    }


    public function update(Request $request, $id)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $request->validate([
                'titulo'=> 'required|max:45',
                'custo' => [new CustoMeta(),'required','numeric','min:0'],
                'descricao' => 'required|max:200',
                'data_inicio_previsto' => [new ValidaInicioMeta(), 'required','before_or_equal:data_fim_previsto'],
                'data_fim_previsto' => [new ValidaFimMeta(), 'required','after_or_equal:data_inicio_previsto'],
                'usuario_login' => 'required|not_in:' . "null|max:20"
            ]);

            $objetivoId = $request->objetivo_id;

            $meta = Meta::find($id)->update($request->all());

            $objetivo = Objetivo::find($objetivoId);

            return redirect('/objetivos' . '/' .  $objetivo->objetivo_id);
        }
        else{
            return redirect('/estrategico');
        }


    }

    public function destroy($id)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $v = Validator::make([],[]);

            $acoes = Acao::where('meta_id', '=', $id)->count();

            $meta = Meta::where('meta_id', '=', $id)->first();
            if($acoes == 0){

                Meta::where('meta_id', '=', $id)->delete();

                return redirect('objetivos/' . $meta->objetivo_id);
            }
            else
            {
                $mensagem = "A Ação possui vínculo com Tarefas. Para realizar a exclusão, é necessário remover o vínculo." ;
                $v->getMessageBag()->add('acoes', $mensagem);

             

                return redirect('objetivos/' . $meta->objetivo_id)->withErrors($v);
            }
        }
        else{
            return redirect('/estrategico');
        }


    }
}
