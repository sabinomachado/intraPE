<?php

namespace App\Http\Controllers;

use App\MetaAndamento;
use Illuminate\Http\Request;
use App\Reuniao;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;




class EstrategicoController extends Controller
{

    public function index()
    {

        $data = $this->ProximaReuniao();
        $metaAberta = $this->MetasAbertas();
        $metaFechada = $this->MetasFechadas();
        $hora = $this->Hora();

        return view('estrategico')->with(['data' => $data, 'metaAberta' => $metaAberta, 'metaFechada' => $metaFechada, 'hora' => $hora]);
    }

    public function ProximaReuniao()
    {
        $hoje = Carbon::parse(Carbon::today());
        $hora = Carbon::parse(Carbon::now());
        $reuniao = DB::table('reunioes')
                ->where('data', '>=', $hoje)

                ->orderBy('data')
                ->first();

       if($reuniao == null)
       {

           return null ;
       }
       else
       {

           return $reuniao->data;
       }

    }

    public function MetasAbertas(){


        $abertas = MetaAndamento::where('andamento', '<>', '100')->get();

        $metaAberta= $abertas->count();

        return $metaAberta;

    }

    public function MetasFechadas(){


        $abertas = MetaAndamento::where('andamento', '=', '100')->get();

        $metaFechada= $abertas->count();

        return $metaFechada;

    }

    public function Hora(){
        $hora = Carbon::parse(Carbon::now())->format('H:m:s');
        

        return $hora;
    }

}
