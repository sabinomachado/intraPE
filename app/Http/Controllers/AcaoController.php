<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Acao;
use App\Models\Meta;
use App\User;
use App\Models\Objetivo;
use Validator;
use App\Rules\CustoAcao;
use App\Tarefa;
use Illuminate\Support\Facades\Gate;
use App\Rules\ValidaAcao;
use App\Rules\ValidaFimAcao;
use App\Rules\ValidaInicioAcao;
use Illuminate\Support\Facades\Auth;




class AcaoController extends Controller
{


    public function index()
    {
        $acoes = Acao::all();

        return view('acoes.index')->with(['acoes' => $acoes]);
    }


    public function create(Request $request)
    {
        $usuarios = User::where('status', '=', 'ativo')->orderBy('nome')->get();

        $user = User::where('login', '=', Auth::user()->login)->first();    

        $meta = Meta::find($request->all() );

        $objetivo = Objetivo::find($request)->sortBy('descricao');

              
        return view('acoes.create')->with(['user' => $user, 'meta' => $meta, 'objetivo' => $objetivo, 'usuarios' =>$usuarios, ]);
    }


    public function store(Request $request)
    {
        //validar os campos

        $request->validate([
            'descricao'=> 'required|max:200',
            'custo' => [new CustoAcao(),'required','numeric'],
            'data_inicio_previsto' => [new ValidaInicioAcao(), 'required','before_or_equal:data_inicio_previsto'],
            'data_fim_previsto' => [new ValidaFimAcao(), 'required','after_or_equal:data_inicio_previsto'],
            'usuario_login' => 'required|not_in:' . "null|max:20"
        ]);

        Acao::create($request->all());

        $meta = Meta::find($request->meta_id );
        $metaId = $request->meta_id;    
        $objetivos = $meta->objetivos()->get();

        $acoes = $meta->acoes()->get();
       
        $somaAcoes = 0;
        foreach($acoes as $acao){
            $somaAcoes += $acao->custo;

        }

        $disponivel = ($meta->custo - $somaAcoes);


        return redirect('/metas' . '/' .  $metaId) -> with(['meta' => $meta, 'objetivos' => $objetivos, 'acoes' => $acoes, 'disponivel'=> $disponivel, 'somaAcoes' => $somaAcoes  ]);
        
    }


    public function show($id)
    {


        $acao = Acao::find($id);

        $meta = $acao->metas()->first();

        $tarefas = $acao->tarefas()->get();

      

        return view('acoes.show') -> with(['acao' => $acao, 'meta' => $meta, 'tarefas' => $tarefas ]);
    }



    public function edit($id)
    {
        //$id = decrypt($id);

        $acao = Acao::find($id);

        $usuarios = User::where('status', '=', 'ativo')->orderBy('nome')->get();

        $user = User::where('login', '=', Auth::user()->login)->first();   

        $usuario= User::where('login', '=', $acao->usuario_id )->get();

        $meta = Meta::find($acao->meta_id);

        $objetivo = Objetivo::find($meta->objetivo_id);

            return view('acoes.edit')-> with(['usuario' => $usuario, 'user' => $user, 'acao' => $acao, 'usuarios' => $usuarios, 'meta' => $meta,'objetivo' => $objetivo]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao'=> 'required|max:200',
            'custo' => [new CustoAcao(),'required','numeric'],
            'data_inicio_previsto' => [new ValidaInicioAcao(), 'required','before_or_equal:data_inicio_previsto'],
            'data_fim_previsto' => [new ValidaFimAcao(), 'required','after_or_equal:data_inicio_previsto'],
            'usuario_login' => 'required|not_in:' . "null|max:20"
        ]);

        $metaId = $request->meta_id;
        $acao = Acao::find($id)->update($request->all());
        $meta = Meta::find($metaId);

        return redirect('/metas' . '/' .  $metaId);


    }


    public function destroy($id)
    {
        $v = Validator::make([],[]);

        $tarefas = Tarefa::where('acao_id', '=', $id)->count();

        $acao = Acao::where('acao_id', '=', $id)->first();
        if($tarefas == 0){

            Acao::where('acao_id', '=', $id)->delete();

            return redirect('metas/' . $acao->meta_id);
        }
        else
        {
            $mensagem = "A Ação possui vínculo com Tarefas. Para realizar a exclusão, é necessário remover o vínculo." ;
            $v->getMessageBag()->add('tarefas', $mensagem);            

            return redirect('metas/' . $acao->meta_id)->withErrors($v);
        }
    }


}
