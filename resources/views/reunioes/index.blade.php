@extends('layouts.app2')

@section('content')
     <link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>

    <div class="body">

        <div class="titulo">
            <h1>Reuniões</h1>
        </div>

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
                <a href="/reunioes/create"><button type="button" class="btn btn-primary"> Novo</button></a>
            </div>
            @endcan

            @can('Administrador')
            <div class="col-11 ">
                <a href="/reunioes/create"><button type="button" class="btn btn-primary"> Novo</button></a>
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
                        <th scope="col">ID</th>
                        <th scope="col">Título </th>
                        <th scope="col">Data </th>
                        <th scope="col">Horário </th>
                        <th scope="col">Ações </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($reunioes as $reuniao)
                        <tr>
                            <th scope="row"> {{ $reuniao->reuniao_id  }}</th>
                            <td> {{ $reuniao->titulo  }}</td>
                            <td>  {{ \Carbon\Carbon::parse($reuniao->data)->format('d/m/Y')}}</td>
                            <td> {{ $reuniao->hora_inicio  }}</td>


                            <td>
                                <a href="{{ route('reunioes.show', ['reuniao' => $reuniao->reuniao_id]) }}"class="btn btn-sm btn-outline-primary" > <i class="fa fa-expand" aria-hidden="true"></i></a>
                                @if( $reuniao->data >= $hoje )
                                <a href="{{ route('reunioes.edit', ['reuniao' => $reuniao->reuniao_id]) }}"class="btn btn-sm btn-outline-success"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                <a onclick="return confirm('Realmente deseja excluir a Reunião?')"href="{{ route('reunioes/destroy', ['reuniao' => $reuniao->reuniao_id]) }}"class="btn btn-sm btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>

        </div>

    </div>

@endsection
