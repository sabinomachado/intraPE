@extends('layouts.app2')

@section('content')



 <link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




    <div class="body">



        <div class="notice notice-acao">

            <strong><h5>  Objetivo: </strong>
                    {{ $objetivo->descricao }}</h5>

                    <b>Valor Orçado:</b> R${{ number_format($objetivo->custo_objetivo, 2, ',', '.') }}
                    <br>
                    <b>Valor Gasto:</b>&nbsp R${{number_format($somaMetas, 2, ',', '.')}} <br>
                    <b>Data Limite:</b> {{ \Carbon\Carbon::parse($objetivo->data_fim)->format('d/m/Y')  }}



                <br>
                <br>

            <div class="card">
                <div class="card-body">
                    <div class="titulo">
                        <h5>Progresso do Objetivo </h5>
                    </div>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width:{{ $objetivo->objetivoAndamento->andamento }}%" aria-valuenow={{ $objetivo->objetivoAndamento->andamento }} aria-valuemin="0" aria-valuemax="100">{{ $objetivo->objetivoAndamento->andamento }}%</div>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="titulo">
            <h1>Metas </h1>
        </div>



        @if($errors->has('acoes'))
        <h6 class="mensagem-erro" id="mensagem-erro" name="mensagem-erro">
            {{ $errors->first('acoes') }}
        </h6>
        @endif

        <div class="row">

            @can('Gerente')
            <div class="col-11 ">

            </div>
            @endcan

            @can('Atendimento')
            <div class="col-11 ">

            </div>
            @endcan

            @can('Desenvolvedor')
            <div class="col-11 ">
                <a href="{{ route('metas.create', ['objetivo' =>$objetivo->objetivo_id]) }}"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan

            @can('Administrador')
            <div class="col-11 ">
                <a href="{{ route('metas.create', ['objetivo' =>$objetivo->objetivo_id]) }}"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan

            <div class="col-1 ">
                <a href="{{ route('perspectivas.show', ['objetivo'=> $objetivo->perspectiva_id ]) }}"><button type="button" class="btn btn-success"> Voltar</button></a>
            </div>

        </div>

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
                        <th scope="col">Custo Realizado </th>
                        <th scope="col">Usuário Responsável </th>
                        <th scope="col">Andamento </th>
                        <th scope="col">Ações </th>

                    </tr>
                </thead>

                    <tbody>
                        @foreach ($metas as $meta)
                            <tr  class={{$meta->tabelameta}}>
                                <th scope="row"> {{ $meta->meta_id }}</th>
                                <td> {{ $meta->titulo}} </td>
                                <td> {{ \Carbon\Carbon::parse($meta->data_inicio_previsto)->format('d/m/Y')  }} </td>
                                <td> {{ \Carbon\Carbon::parse($meta->data_fim_previsto)->format('d/m/Y')  }} </td>
                                <td> R${{  number_format($meta->custo, 2, ',', '.')  }} </td>
                                <td> R${{  number_format($meta->valor, 2, ',', '.')  }} </td>
                                <td> {{ strtoupper($meta->usuarios->nome)}} </td>
                                <td align="center"> {{ $meta->metaAndamento->andamento }} % </td>
                                <td>
                                    <a href="{{ route('metas.show', ['meta' => $meta->meta_id]) }}" class="btn btn-sm btn-outline-primary" > <i class="fa fa-expand" aria-hidden="true"></i></a>
                                    @if(Gate::check('Administrador') || Gate::check('Desenvolvedor'))
                                    <a href="{{ route('metas.edit', ['meta' =>$meta->meta_id]) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                    <a onclick="return confirm('Realmente deseja excluir a Meta?')" href="{{ route('metas/destroy', ['meta' => $meta->meta_id]) }}" class="btn btn-sm btn-outline-danger" > <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

            </table>
        </div>

        <br>



       </div>






@endsection
