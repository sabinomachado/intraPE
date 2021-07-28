<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Validator;

use App\User;
use App\Funcionarios;



class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

            $diasAniversario = $this->CalculaDiasAniversario();
            $displayAniversario = $this->PrazoAnuncioAniversario($diasAniversario);
            $mensagemAniversario =$this->MensagemAniversario($diasAniversario);

            $diasFerias = $this->CalculaDiasFerias();
            $displayFerias = $this->PrazoAnuncioFerias($diasFerias);
            $mensagemFerias =$this->MensagemFerias($diasFerias);

           


            return view('home', compact('diasAniversario','displayAniversario','mensagemAniversario','diasFerias','displayFerias','mensagemFerias','usuarios'));




    }

    // {{ --  ANIVERSÁRIO...
    private function CalculaDiasAniversario(){

            $hoje = Carbon::parse(Carbon::today());
            $aniversario = Carbon::parse(Auth::user()->data_nascimento);
            $tempo = $hoje->diffInDays($aniversario);
            $ano = ($tempo/365.25);
            $diasAniversario = (((($tempo/365.25)-intval($ano))*365.25)-366)*-1;

        return $diasAniversario;
    }


    public function PrazoAnuncioAniversario($diasAniversario){
            if($diasAniversario>=15)
                return 'true';
                else
                return 'none';
    }

    public function MensagemAniversario($diasAniversario){
        if($diasAniversario==0)
        return 'Parabéns, hoje é seu aniversário !';
        else
        return 'Faltam '.$diasAniversario.' dias para o seu aniversário !';

    }

    // ...ANIVERSÁRIO -- }}

    // {{ --  FÉRIAS...
        private function CalculaDiasFerias(){

            $hoje = Carbon::parse(Carbon::today());

            if (Auth::user()->getDadosFuncionario()->exists())
                $diasFerias = Auth::user()->getDadosFuncionario->ferias_inicio;
            else
                $diasFerias = '121';



        return $diasFerias;
    }


    public function PrazoAnuncioFerias($diasFerias){
            if($diasFerias<=120)
                return 'true';
                else
                return 'none';
    }

    public function MensagemFerias($diasFerias){
        if($diasFerias==0)
        return 'Parabéns, hoje é seu aniversário !';
        else
        return 'Faltam '.$diasFerias.' dias para as suas férias !';

    }

    // ...FÉRIAS -- }}


}
