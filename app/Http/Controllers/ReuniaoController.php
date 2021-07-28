<?php

namespace App\Http\Controllers;

use App\Reuniao;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Rules\DataReuniao;

class ReuniaoController extends Controller
{
    public function index()
    {
        $reunioes = Reuniao::all();
        $hoje = Carbon::parse(Carbon::today());
        return view('reunioes.index')->with(['reunioes' => $reunioes, 'hoje' =>$hoje ]);
    }

    public function create()
    {
        return view('reunioes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'=> 'required|max:45',
            'data' => [new DataReuniao(),'required'],
            'hora_inicio' => 'required',
            'descricao' => 'required|max:200',

        ]);

        Reuniao::create($request->all());
        return redirect()->route('reunioes.index');
    }

    public function show($id)
    {
        $reuniao = Reuniao::find($id);
        return view('reunioes.show') -> with(['reuniao'=>$reuniao]);
    }


    public function edit($id)
    {
        $reuniao = Reuniao::find($id);
        return view('reunioes.edit')-> with(['reuniao' => $reuniao]);
    }


    public function update(Request $request, $id)
    {
        $reuniao = Reuniao::find($id)->update($request->all());
        return redirect()->route('reunioes.index');
    }


    public function destroy(Reuniao $reuniao)
    {
        $v = Validator::make([], []);

        $reuniao = Reuniao::find($id);
       

            $reuniao = $reuniao->delete();
            if ($reuniao) {
                return redirect()->back();


            }
        
        
    }
}
