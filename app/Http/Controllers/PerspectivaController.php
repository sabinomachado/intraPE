<?php

namespace App\Http\Controllers;

use App\Models\Objetivo;
use Illuminate\Http\Request;
use App\Models\Perspectiva;
use Validator;
use Illuminate\Support\Facades\Gate;

class PerspectivaController extends Controller
{

    public function index()
    {

          $perspectivas = Perspectiva::all();

        return view('perspectivas.index')->with(['perspectivas' => $perspectivas]);
    }


    public function create()
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            return view('perspectivas.create');
        }
        else{
            return redirect('/estrategico');
        }


    }


    public function store(Request $request)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $request->validate([
                'titulo' => 'required','max:45',
                'descricao'=> 'required|max:200',
            ]);


            Perspectiva::create($request->all());

            return redirect()->route('perspectivas.index');
        }
        else{
            return redirect('/estrategico');
        }


    }


    public function show($id)
    {


        $perspectiva = Perspectiva::find($id);


        $objetivos = $perspectiva->objetivos()->get();


        return view('perspectivas.show') -> with(['perspectiva' => $perspectiva , 'objetivos' => $objetivos]);
    }


    public function edit($id)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $perspectiva = Perspectiva::find($id);
            return view('perspectivas.edit')-> with(['perspectiva' => $perspectiva]);
        }
        else{
            return redirect('/estrategico');
        }


    }


    public function update(Request $request, $id)
    {


        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $request->validate([
                'titulo' => 'required','max:45',
                'descricao'=> 'required|max:200',
            ]);

            $perspectiva = Perspectiva::find($id);

            $perspectiva = Perspectiva::find($id)->update($request->all());
            return redirect()->route('perspectivas.index');
        }
        else{
            return redirect('/estrategico');
        }

    }


    public function destroy($id)
    {
        if ((Gate::allows('Administrador'))||(Gate::allows('Desenvolvedor'))) {
            $v = Validator::make([],[]);

            $objetivos = Objetivo::where('perspectiva_id', '=', $id)->count();

            if($objetivos == 0){
                $perspectiva = Perspectiva::where('perspectiva_id', '=', $id)->delete();

                return redirect('perspectivas');
            }
            else
            {
                $mensagem = "A Perspectiva possui vínculo com Objetivos. Para realizar a exclusão, é necessário remover o vínculo." ;
                $v->getMessageBag()->add('objetivos', $mensagem);

                return redirect('perspectivas')->withErrors($v);
            }
        }
        else{
            return redirect('/estrategico');
        }


    }
}
