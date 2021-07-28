@extends('layouts.app2')

@section('content')
<link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
<link rel=stylesheet href="{{ asset ('css/estrategico.css')}}"/>




<div class="body">

<div>
    <div>
            {{-- INÍCIO DO CARD --}}
                <div>
                <div class="notice notice-{{ $acao->cor }}">
                        <strong><h5> Ação: </strong>  {{ $acao->descricao }}</h5>

                        <strong> Data Início Previsto: </strong>  {{ \Carbon\Carbon::parse($acao->data_inicio_previsto)->format('d/m/Y')}}

                            <br>
                        <strong> Data Fim Previsto: </strong> {{ \Carbon\Carbon::parse($acao->data_fim_previsto)->format('d/m/Y')}}
                            <br>
                        <strong> Meta: </strong> {{ $meta->titulo }}
                    </div>

                    <br>

                    <div class="card">
                        <div class="card-body" >
                            <div class="titulo">
                                <h5>Progresso da Ação</h5>
                            </div>

                            <div class="progress">
                            <div class="progress-bar " role="progressbar" style="width:{{$acao->media}}%; background-color: {{$acao->cor}}"  aria-valuenow="{{$acao->media}}" aria-valuemin="0" aria-valuemax="100">{{$acao->media}}%</div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- FINAL DO CARD --}}
</div>



        <br>


        <div class="titulo">
            <h1>Tarefas</h1>
        </div>

        @if($errors->has('tarefas'))
        <h6 class="mensagem-erro" id="mensagem-erro" name="mensagem-erro">
            {{ $errors->first('tarefas') }}
        </h6>
        @endif


        <div class="row">
            <div class="col-11 ">
                <a href="{{ route('tarefas.create', ['acao' =>$acao->acao_id]) }}"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>

            <div class="col-1 ">
                <a href="{{ route('metas.show', ['meta' =>$meta->meta_id]) }}"><button type="button" class="btn btn-success"> Voltar</button></a>
            </div>

        </div>

        <br>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">

                    <thead>
                        <tr>
                            <th scope="col"># </th>
                            <th scope="col">Título </th>
                            <th scope="col">Início Previsto </th>
                            <th scope="col">Fim Previsto </th>
                            <th scope="col">Custo </th>
                            <th scope="col">Última Atualização </th>
                            <th scope="col">Responsável </th>
                            <th scope="col">Andamento </th>
                            <th scope="col">Ações </th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tarefas as $tarefa)
                            <tr>
                                <th scope="row"> {{ $tarefa->tarefa_id  }} </th>
                                    <td> {{ $tarefa->descricao  }} </td>
                                    <td> {{ \Carbon\Carbon::parse($tarefa->data_inicio_previsto)->format('d/m/Y')}} </td>
                                    <td> {{ \Carbon\Carbon::parse($tarefa->data_fim_previsto)->format('d/m/Y')}} </td>
                                    <td> R$ {{$tarefa->custo}} </td>
                                    <td> {{ \Carbon\Carbon::parse($tarefa->updated_at)->format('d/m/Y - H:i:s')}} </td>
                                    <td> {{ $tarefa->usuarios->nome}} </td>
                                    <td align="center"> {{ number_format($tarefa->andamento, 2, '.', '') }} % </td>
                                    <td>
                                        <a href="{{ route('tarefas.show', ['tarefa' => $tarefa->tarefa_id]) }}" class="btn btn-sm btn-outline-primary" > <i class="fa fa-expand" aria-hidden="true"></i></a>
                                        @if( Auth::user()->login == $tarefa->usuario_login)
                                        <a href="{{ route('tarefas.edit', ['tarefa' => $tarefa->tarefa_id]) }}" class="btn btn-sm btn-outline-success" > <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        @endif

                                        @if (( Auth::user()->login == $tarefa->usuario_login ) && ($tarefa->andamento <= 0))
                                        <a onclick="return confirm('Realmente deseja excluir a Tarefa?')" href="{{ route('tarefas/destroy', ['tarefa' => $tarefa->tarefa_id]) }}" class="btn btn-sm btn-outline-danger" > <i class="fa fa-trash" aria-hidden="true"></i></a>
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
</div>


@endsection
