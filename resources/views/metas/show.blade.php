@extends('layouts.app2')

@section('content')
<link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
<link rel=stylesheet href="{{ asset ('css/estrategico.css')}}"/>

<div class="body">

        <div class="notice notice-acao">
             @foreach ($objetivos as $objetivo)


            @endforeach

            <strong><h5> Meta: </strong>  {{ $meta->titulo }}</h5>
            <strong> Descrição: </strong>{{ $meta->descricao }}
            <br>
            <strong>Gasto Orçado(Meta):</strong> R${{number_format($meta->custo, 2, ',', '.')}}
            <br>
            <strong>Gasto Realizado(Ação):</strong> R${{number_format($somaAcoes, 2, ',', '.')}}
            <br>
            {{-- <strong>Valor Disponível:</strong> R${{number_format($disponivel, 2, ',', '.')}}
            <br> --}}
            <strong>Prazo Final:</strong> {{ \Carbon\Carbon::parse($meta->data_fim_previsto)->format('d/m/Y')  }}

            <div class="card">
                <div class="card-body">
                    <div class="titulo">
                        <h5>Progresso da Meta </h5>
                    </div>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width:{{ $meta->metaAndamento->andamento }}%" aria-valuenow={{ $meta->metaAndamento->andamento }} aria-valuemin="0" aria-valuemax="100">{{ $meta->metaAndamento->andamento }}%</div>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="titulo">
            <h1>Ações </h1>
        </div>

        @if($errors->has('tarefas'))
        <h6 class="mensagem-erro" id="mensagem-erro" name="mensagem-erro">
            {{ $errors->first('tarefas') }}
        </h6>
        @endif

        <div class="row">
            @can('Gerente')
            <div class="col-11 ">
                <a href="{{ route('acoes.create', ['meta' => $meta->meta_id]) }}"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan

            @can('Atendimento')
            <div class="col-11 ">

            </div>
            @endcan

            @can('Desenvolvedor')
            <div class="col-11 ">
                <a href="{{ route('acoes.create', ['meta' => $meta->meta_id]) }}"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan

            @can('Administrador')
            <div class="col-11 ">
                <a href="{{ route('acoes.create', ['meta' => $meta->meta_id]) }}"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan

            <div class="col-1 ">
                <a href="{{ route('objetivos.show', ['objetivo'=> $objetivo->objetivo_id ]) }}"><button type="button" class="btn btn-success"> Voltar</button></a>
            </div>

        </div>

        <br>



        <br>

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-sm">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título </th>
                    <th scope="col">Início Previsto </th>
                    <th scope="col">Fim Previsto </th>
                    <th scope="col">Custo Previsto </th>
                    <th scope="col">Custo Realizado</th>
                    <th scope="col">Última Atualização </th>
                    <th scope="col">Responsável </th>
                    <th scope="col">Andamento </th>
                    <th scope="col">Ações </th>

                </tr>
            </thead>

            <tbody>
                @foreach ($acoes as $acao)
                    <tr class={{$acao->tabelaacao}}>
                        <th scope="row"> {{ $acao->acao_id  }} </th>
                            <td> {{ $acao->descricao  }} </td>
                            <td> {{ \Carbon\Carbon::parse($acao->data_inicio_previsto)->format('d/m/Y')}} </td>
                            <td> {{ \Carbon\Carbon::parse($acao->data_fim_previsto)->format('d/m/Y')  }} </td>
                            <td> R$ {{ number_format($acao->custo, 2, ',', '.') }} </td>
                            <td> R$ {{ number_format($acao->valor, 2, ',', '.') }} </td>
                            <td> {{ \Carbon\Carbon::parse($acao->updated_at)->format('d/m/Y - H:i:s')  }} </td>
                            <td> {{ strtoupper($acao->usuarios)}} </td>
                            <td align="center"> {{ number_format($acao->media, 2, '.', ',') }} % </td>
                            <td>
                                <a href="{{ route('acoes.show', ['acao' => $acao->acao_id]) }}" class="btn btn-sm btn-outline-primary" > <i class="fa fa-expand" aria-hidden="true"></i></a>

                                @if((Gate::check('Administrador') || Gate::check('Desenvolvedor') || Gate::check('Gerente')) AND (Auth::user()->login == $acao->usuario_login))
                                <a href="{{ route('acoes.edit', ['acao' => $acao->acao_id]) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                <a onclick="return confirm('Realmente deseja excluir a Ação?')" href="{{ route('acoes/destroy', ['acao' => $acao->acao_id]) }}" class="btn btn-sm btn-outline-danger" > <i class="fa fa-trash" aria-hidden="true"></i></a>
                                @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>


</div>


</div>

@endsection
