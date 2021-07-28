@extends('layouts.app2')

@section('content')
<link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
<link rel=stylesheet href="{{ asset ('css/estrategico.css')}}"/>

<div class="body">

    <div class="notice notice-blue">
         <h3>  <strong> Reunião: </strong>  {{ $reuniao->titulo }}</h3>
    </div>
    <br>

   <div class="card-deck">
        <div class="card bg-light-gray">
            <div class="card-body text-center">
                <p class="card-text">Data: <br> <h1>{{ \Carbon\Carbon::parse($reuniao->data)->format('d/m/Y')}}</h1></p>
            </div>
        </div>
        <div class="card bg-light-gray">
            <div class="card-body text-center">
                <p class="card-text">Horário Inicial: <br> <h1>{{$reuniao->hora_inicio}}</h1></p>
            </div>
        </div>
   </div>

   <br>

    <div class="form-group">
        <label for="comment">Descrição:</label>
        <textarea class="form-control" type="text" name="descricao" rows="5" id="descricao" readonly> {{old('acao', $reuniao->descricao) }}</textarea>
    </div>


    <div class="row">
        <div class="col-11 ">

        </div>


        <div class="col-1 ">
            <a href="/reunioes"><button type="button" class="btn btn-success"> Voltar</button></a>
        </div>
    </div>



@endsection
