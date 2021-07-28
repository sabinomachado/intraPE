<?php

namespace App\Http\Controllers;

use App\Models\Objetivo;
use App\Models\Meta;
use App\Models\Perspectiva;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Support\Facades\Gate;
use App\User;

class ObjetivoController extends Controller
{

    public function index()
    {
        $objetivos = Objetivo::all();

        return view('objetivos.index')->with(['objetivos' => $objetivos]);
    }


    public function create(Request $request)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $perspectiva = Perspectiva::find($request->all());
            return view('objetivos.create')->with(['perspectiva' => $perspectiva]);
        }
        else{
            return redirect('/estrategico');
        }



    }


    public function store(Request $request)
    {
        $request->validate([
            'descricao'=> 'required|max:200',
            'custo_objetivo' => 'required',
            'data_inicio' => 'required|before_or_equal:data_fim',
            'data_fim' => 'required|after_or_equal:data_inicio',
        ]);
        Objetivo::create($request->all());
       // $perspectiva = Perspectiva::find($request)->first();
        $perspectiva = Perspectiva::find($request->perspectiva_id);
        return redirect()->route('perspectivas.show', ['perspectiva'=> $perspectiva]);
    }


    public function show($id)
    {

            $objetivo = Objetivo::find($id);

        $perspectivas = $objetivo->perspectivas()->get();

        $metas = $objetivo->metas()->get();

        $somaMetas = 0;
        foreach($metas as $meta){
            $somaMetas += $meta->custo;

        }




        return view('objetivos.show') -> with(['objetivo' => $objetivo, 'perspectivas' => $perspectivas, 'metas' => $metas, 'somaMetas'=> $somaMetas]);



    }


    public function edit($id)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $objetivo = Objetivo::find($id);

            $perspectiva = Perspectiva::find($objetivo->perspectiva_id);
           return view('objetivos.edit')-> with(['objetivo' => $objetivo,  'perspectiva' => $perspectiva ]);
        }
        else{
            return redirect('/estrategico');
        }


    }


    public function update(Request $request, $id)
    {

        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $request->validate([
                'descricao'=> 'required|max:200',
                'custo_objetivo' => 'required',
                'data_inicio' => 'required|before_or_equal:data_fim',
                'data_fim' => 'required|after_or_equal:data_inicio',
            ]);

            $perspectivaId = $request->perspectiva_id;
            $objetivo = Objetivo::find($id)->update($request->all());
            $perspectiva = Perspectiva::find($perspectivaId);

            return redirect('/perspectivas' . '/' .  $perspectiva->perspectiva_id);

        }
        else{
            return redirect('/estrategico');
        }





    }


    public function destroy($id)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $v = Validator::make([], []);

            $metas = Meta::where('objetivo_id', '=', $id)->count(); //conta as metas

            $objetivo = Objetivo::where('objetivo_id', '=', $id)->first();
            if ($metas == 0) {
                Objetivo::where('objetivo_id', '=', $id)->delete();

                return redirect('perspectivas/' . $objetivo->perspectiva_id);
            } else {
                $mensagem = "O Objetivo possui vínculo com Metas. Para realizar a exclusão, é necessário remover o vínculo." ;
                $v->getMessageBag()->add('metas', $mensagem);

                return redirect('perspectivas/'. $objetivo->perspectiva_id)->withErrors($v);//ver rota w/ para...
            }
        } else {
            return redirect('/estrategico');
        }
    }
}
