<?php

namespace App\Http\Controllers;

use App\Tarefa;
use App\Models\Meta;
Use App\Acao;
Use App\Models\Objetivo;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Gate;
use App\Rules\ValidaInicioTarefa;
use App\Rules\ValidaFimTarefa;
use App\Rules\AndamentoTarefa;



use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Request $request)
    {
        
        $usuarios = User::where('status', '=', 'ativo')->orderBy('nome')->get();

        $user = User::where('login', '=', Auth::user()->login)->first();           

        $acao = Acao::find($request->all());
        //$metaId = Meta::where('meta_id', '=', '')->orderBy('nome')->get();

        $meta = Meta::find($request)->sortBy('descricao');
        //dd($acao);

        $objetivo = Objetivo::find($request);





         return view('tarefas.create')->with(['meta' => $meta, 'objetivo' => $objetivo, 'usuarios' =>$usuarios, 'acao' => $acao, 'user' => $user]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'descricao'=> 'required|max:200',
            'data_inicio_previsto' => [new ValidaInicioTarefa(), 'required','after_or_equal:data_inicio_previsto'],
            'data_fim_previsto' => 'required','after_or_equal:data_inicio_previsto',
            'usuario_login' => 'required|not_in:' . "null|max:20"
        ]);

        Tarefa::create($request->all());

        $acao = Acao::find($request->acao_id);

        $tarefas = $acao->tarefas()->get();

        $meta = $acao->metas()->first();
       
        return redirect('/acoes' . '/' .  $acao->acao_id);    
        
    }

    public function destroy($id)
    {

        $v = Validator::make([], []);

        $tarefa = Tarefa::find($id);
        $acaoId = $tarefa->acao_id;
        if (
            (Auth::user()->login == $tarefa->usuario_login) &&
            ($tarefa->andamento <= 0)
        ) {

            $tarefa = $tarefa->delete();
            if ($tarefa) {
                                
                return redirect('/acoes' . '/' .  $acaoId);

            }
        }
         else {
                $mensagem = "Ação não autorizada!" ;
                $v->getMessageBag()->add('tarefas', $mensagem);

                return redirect('/acoes' . '/' .  $acaoId)->withErrors($v);
              
        }


    }

    public function show($id)
    {
        $tarefa = Tarefa::find($id);

        $acao = $tarefa->acoes()->first();

        $meta = $acao->metas()->first();

        $usuario= User::where('login', '=', $acao->usuario_id )->get();

        return view('tarefas.show') -> with(['tarefa' => $tarefa, 'acao' => $acao, 'meta' => $meta, 'usuario' => $usuario]);
    }


    public function edit($id)
    {
        $tarefa = Tarefa::find($id);

        $usuario= User::where('login', '=', $tarefa->usuario_id )->get();

        $user = User::where('login', '=', Auth::user()->login)->first();  

        $usuarios = User::all();

        $acao = Acao::find($tarefa->acao_id);

        $meta = $acao->metas()->first();

        return view('tarefas.edit')-> with(['acao'=>$acao, 'tarefa'=>$tarefa,  'usuario' => $usuario, 'usuarios' => $usuarios,  'meta' =>$meta, 'user' => $user]);
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao'=> 'required|max:200',
            'data_inicio_previsto' => [new ValidaInicioTarefa(), 'required','after_or_equal:data_inicio_previsto'],
            'data_fim_previsto' =>  'required','after_or_equal:data_inicio_previsto',
            'andamento' => [new AndamentoTarefa(), 'required'],
            'usuario_login' => 'required|not_in:' . "null|max:20"
        ]);
        $acaoId = $request->acao_id;

        $tarefa = Tarefa::find($id)->update($request->all());

        $acao = Acao::find($acaoId);

        return redirect('/acoes' . '/' .  $acao->acao_id);




    }








}
