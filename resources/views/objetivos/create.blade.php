@extends('layouts.app2')

@section('content')

<div class="container">

        <form action="{{ route('objetivos.store') }}" class="form-horizontal" method="POST">
            @csrf

           <div class="titulo">
                <h1 >Objetivo </h1>
            </div>

            <br>

            <div class="notice notice-blue">


                <strong>  Perspectiva: </strong>
                @foreach ($perspectiva as $pt)
                         {{$pt->titulo}}
                @endforeach

                <br>
            </div>

            <br>

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif

                <div class="form-group">

                        <label for="comment"><b>Descrição</b></label>
                <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" rows="5" id="descricao" >{{old('descricao')}}</textarea>
                        @if($errors->has('descricao'))
                        <div class=" {{$errors->has('descricao') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('descricao')}}
                        </div>
                        @endif

                </div>

                <div class="row">

                    <div class="col-5 form-group">
                            <label><b>Início</b> </label>
                            <input value="{{old('data_inicio')}}"class="form-control {{ $errors->has('data_inicio') ? 'is-invalid' : '' }}" type="date" name="data_inicio"  id="data_inicio" >
                            @if($errors->has('data_inicio'))
                            <div class=" {{$errors->has('data_inicio') ? 'invalid-feedback' : ''}}">
                                {{$errors->first('data_inicio')}}
                            </div>
                         @endif
                    </div>

                    <div class="col-5 form-group">
                            <label><b>Fim</b> </label>
                            <input value="{{old('data_fim')}}"class="form-control {{ $errors->has('data_fim') ? 'is-invalid' : '' }}" type="date" name="data_fim"  id="data_fim">
                            @if($errors->has('data_fim'))
                            <div class=" {{$errors->has('data_fim') ? 'invalid-feedback' : ''}}">
                                {{$errors->first('data_fim')}}
                            </div>
                         @endif
                    </div>

                    <div class="col-2 form-group">
                        <label for="comment"><b>Custo</b></label>
                        <input value="{{old('custo_objetivo')}}"class="form-control {{ $errors->has('custo_objetivo') ? 'is-invalid' : '' }}" type="number" name="custo_objetivo" rows="1" id="custo_objetivo" ></textarea>
                        @if($errors->has('custo_objetivo'))
                        <div class=" {{$errors->has('custo_objetivo') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('custo_objetivo')}}
                        </div>
                     @endif
                    </div>

                </div>



                <input type="hidden" name="perspectiva_id" id="perspectiva_id" value={{ $pt->perspectiva_id }}>


        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold">Salvar</button>
            <button type="reset" class="btn btn-outline-danger ml-2" style="font-size: 12px; font-weight: bold"
            onclick="window.location.href='/perspectivas/{{$pt->perspectiva_id}}'">Cancelar </button>

        </div>




        </form>
    </div>
</div>

@endsection
