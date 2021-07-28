@extends('layouts.app2')

@section('content')
     <link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>

    <div class="body">

        <div class="titulo">
            <h1>Perspectivas</h1>
        </div>

        @if($errors->has('objetivos'))
                <h6 class="mensagem-erro" id="mensagem-erro" name="mensagem-erro">
                    {{ $errors->first('objetivos') }}
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
                <a href="/perspectivas/create"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan

            @can('Administrador')
            <div class="col-11 ">
                <a href="/perspectivas/create"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan


            <div class="col-1 ">
                <a href="/estrategico"><button type="button" class="btn btn-success"> Voltar</button></a>
            </div>

        </div>




        <br>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">

                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título </th>
                        <th scope="col">Andamento</th>
                        <th scope="col">Ações </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($perspectivas as $perspectiva)
                        <tr>
                            <th scope="row"> {{ $perspectiva->perspectiva_id  }}</th>
                            <td> {{ $perspectiva->titulo  }}</td>
                            <td align="center">{{ $perspectiva->perspectivaAndamento->andamento  }} % </td>
                            <td>
                                <a href="{{ route('perspectivas.show', ['perspectiva' => $perspectiva->perspectiva_id]) }}"class="btn btn-sm btn-outline-primary" > <i class="fa fa-expand" aria-hidden="true"></i></a>

                                @if(Gate::check('Administrador') || Gate::check('Desenvolvedor'))
                                <a href="{{ route('perspectivas.edit', ['perspectiva' => $perspectiva->perspectiva_id]) }}"class="btn btn-sm btn-outline-success"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                <a onclick="return confirm('Realmente deseja excluir a perspectiva?')" href="{{ route('perspectivas/destroy', ['perspectiva' => $perspectiva->perspectiva_id]) }}"class="btn btn-sm btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>

        </div>

    </div>






@endsection




