@extends('layouts.app2')

@section('content')
<link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
<link rel=stylesheet href="{{ asset ('css/estrategico.css')}}"/>

<div class="body">

         <div class="notice notice-blue">
                <strong> Ação: </strong>  {{ $acao->descricao }}
                    <br>
                <strong> Data Inicio Previsto: </strong>  {{ \Carbon\Carbon::parse($acao->data_inicio_previsto)->format('d/m/Y')}}

                    <br>
                <strong> Data Fim Previsto: </strong>  {{ \Carbon\Carbon::parse($acao->data_fim_previsto)->format('d/m/Y')  }}
                    <br>
                <strong> Meta: </strong> {{ $meta->titulo }}
                <br>
                <strong> Usuário Responsável: </strong>
                
                    {{$tarefa->usuarios->apelido}}
                


        </div>


        <div class="card">
            <div class="card-body">
                <div class="titulo">
                <h5>Progresso Desta Tarefa</h5>
                </div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width:{{ $tarefa->andamento }}%" aria-valuenow={{ $tarefa->andamento }} aria-valuemin="0" aria-valuemax="100">{{ $tarefa->andamento }}%</div>
                </div>
            </div>
        </div>

        <br>

        <div class="msg" id="accordion" style="display: {{$tarefa->status}};">
            <div class="card">
              <div class="card-header" id="headingTwo">

                <h5 class="mb-0 vencido">
                    ATENÇÃO! Tarefa vencida!

                </h5>
              </div>

            </div>

          </div>

        <div class="container">


                <div class="form-group">
                    <label for="comment">Descrição</label>
                    <textarea class="form-control" type="text" name="descricao" rows="5" id="descricao" readonly> {{old('acao', $tarefa->descricao) }}</textarea>
                </div>


                <div class="row">
                    <div class="col-3 form-group">
                            <label>Fim Previsto </label>
                            <input class="form-control" type="date" name="data_inicio_previsto"  id="data_inicio_previsto"   value="{{old('tarefa', $tarefa->data_fim_previsto) }}" readonly>
                    </div>

                    <div class="col-3 form-group">
                            <label>Ultima Atualização </label>
                            <input class="form-control" type="date" name="data_fim_previsto"  id="data_fim_previsto" value="{{old('tarefa', $tarefa->data_fim_previsto) }}" readonly>
                    </div>

                    <div class="col-3 form-group">
                        <label>Dias Restantes </label>
                        <input class="form-control" type="text" placeholder=" {{$tarefa->diasfim}} " id="meta_id" readonly>
                    </div>


                    <div class="col-3 form-group">
                        <label>Andamento </label>
                        <input class="form-control" type="text" placeholder=" {{$tarefa->andamento}}% " id="meta_id" readonly>
                    </div>


                </div>

                <div class="row">
                    <div class="col-11 ">

                    </div>

                    <div class="col-1 ">
                        <a href="{{ route('acoes.show', ['tarefa' =>$tarefa->acao_id]) }}"><button type="button" class="btn btn-success"> Voltar</button></a>
                    </div>

                </div>

        </div>





@endsection
