
@extends('layouts.app2')

@section('content')



 <link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




    <div class="body">

        <div class="notice notice-acao">

            <strong><h5>  Perspectiva: </strong>
                    {{ $perspectiva->titulo }}</h5>

            <div class="card">
                <div class="card-body">
                    <div class="titulo">
                        <h5>Progresso da Perspectiva </h5>
                    </div>

                    <div class="progress">
                         <div class="progress-bar" role="progressbar" style="width:{{ $perspectiva->perspectivaAndamento->andamento }}%" aria-valuenow={{ $perspectiva->perspectivaAndamento->andamento }} aria-valuemin="0" aria-valuemax="100">{{ $perspectiva->perspectivaAndamento->andamento }}%</div>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="titulo">
            <h1>Objetivos </h1>
        </div>


         @if($errors->has('metas'))
                <h6 class="mensagem-erro" id="mensagem-erro" name="mensagem-erro">
                    {{ $errors->first('metas') }}
                </h6>
         @endif


        <br>

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
                <a href="{{ route('objetivos.create', ['perspectiva' =>$perspectiva->perspectiva_id]) }}" class="btn btn-sucess"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan

            @can('Administrador')
            <div class="col-11 ">
                <a href="{{ route('objetivos.create', ['perspectiva' =>$perspectiva->perspectiva_id]) }}"><button type="button" class="btn btn-primary">Novo</button></a>
            </div>
            @endcan

            <div class="col-1 ">
                <a href="{{ route('perspectivas.index') }}"><button type="button" class="btn btn-success"> Voltar</button></a>
            </div>

        </div>


        <br>
        <br>


          <div class="table-responsive">

            <table class="table table-striped table-bordered table-sm">
                 <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição </th>
                        <th scope="col">Fim Previsto </th>
                        <th scope="col">Custo Previsto</th>
                        <th scope="col">Custo Realizado</th>
                        <th scope="col">Andamento </th>
                        <th scope="col">Ações </th>

                    </tr>
                </thead>

                    <tbody>
                        @foreach ($objetivos as $objetivo)
                        <tr  class={{$objetivo->tabelaobjetivo}}>
                                <th scope="row"> {{ $objetivo->objetivo_id  }} </th>
                                <td> {{ $objetivo->descricao  }} </td>
                                <td> {{ \Carbon\Carbon::parse($objetivo->data_fim)->format('d/m/Y')  }} </td>
                                <td> R$ {{ number_format($objetivo->custo_objetivo,2, ',', '.')  }} </td>
                                <td> R${{  number_format($objetivo->valor, 2, ',', '.')  }} </td>
                                <td align="center"> {{ $objetivo->objetivoAndamento->andamento }} % </td>

                                <td>
                                    <a href="{{ route('objetivos.show', ['objetivo'=> $objetivo->objetivo_id ]) }}" class="btn btn-sm btn-outline-primary" > <i class="fa fa-expand" aria-hidden="true"></i></a>
                                    @if(Gate::check('Administrador') || Gate::check('Desenvolvedor'))
                                    <a href="{{ route('objetivos.edit', ['objetivo'=> $objetivo->objetivo_id]) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                    <a onclick="return confirm('Realmente deseja excluir o objetivo?')" href="{{ route('objetivos/destroy', ['objetivo' => $objetivo->objetivo_id]) }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

            </table>
        </div>

        <br>

        <br>
        <br>



       </div>




@endsection
