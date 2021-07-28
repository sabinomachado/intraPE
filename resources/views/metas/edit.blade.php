@extends('layouts.app2')

@section('content')

<div class="container">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


            <form action="{{ route('metas.update', ['perspectiva' => $meta->meta_id]) }}" class="form-horizontal" method="POST">
                @csrf
                @method('PUT')

                <div class="titulo">
                    <h1>METAS</h1>
                </div>

                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif


                <div class="notice notice-blue">


                    <strong>  Objetivo: </strong>

                            {{$objetivo->descricao}}
                    <br>
                    <strong> Prazo Final:  </strong>  {{  \Carbon\Carbon::parse($objetivo->data_fim)->format('d/m/Y')   }}
                    <br>
                    <strong> Custo Total:  </strong> R${{ number_format($objetivo->custo_objetivo, 2, ',', '.') }}

                </div>


                <div class="row form-group">
                    <div class="col-12">
                        <label><b>Título</b> </label>
                        <input  class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo"  id="titulo" value="{{old('meta', $meta->titulo) }} ">
                        @if($errors->has('titulo'))
                        <div class=" {{$errors->has('titulo') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('titulo')}}</div>
                        @endif
                    </div>
                </div>





                <div class="form-group">
                    <label for="comment"><b>Descrição</b></label>
                    <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" rows="5" id="descricao">{{  old('meta', $meta->descricao) }}</textarea>
                    @if($errors->has('descricao'))
                        <div class=" {{$errors->has('descricao') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('descricao')}}</div>
                        @endif
                </div>

                <div class="row">
                    <div class="col-3 form-group">
                            <label><b>Início Previsto</b> </label>
                            <input  class="form-control {{ $errors->has('data_inicio_previsto') ? 'is-invalid' : '' }}" type="date" name="data_inicio_previsto"  id="data_inicio_previsto" value="{{old('meta', $meta->data_inicio_previsto) }}">
                            @if($errors->has('data_inicio_previsto'))
                        <div class=" {{$errors->has('data_inicio_previsto') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('data_inicio_previsto')}}</div>
                        @endif
                    </div>

                    <div class="col-3 form-group">
                            <label><b>Fim Previsto</b> </label>
                            <input  class="form-control {{ $errors->has('data_fim_previsto') ? 'is-invalid' : '' }}" type="date" name="data_fim_previsto"  id="data_fim_previsto" value="{{old('meta', $meta->data_fim_previsto) }}">
                            @if($errors->has('data_fim_previsto'))
                                <div class=" {{$errors->has('data_fim_previsto') ? 'invalid-feedback' : ''}}">
                                    {{$errors->first('data_fim_previsto')}}
                                </div>
                            @endif
                    </div>

                    <div class="col-4 form-group">
                        <label><b>Usuário Responsável</b> </label>
                        <select class="form-control {{ $errors->has('usuario_login') ? 'is-invalid' : '' }}" name="usuario_login" id="usuario_login" >

                            @if(old('usuario_login') == null)
                                @foreach($usuarios as $usuario)
                                    <option value="{{$usuario->login}}" {{ $meta->usuario_login == $usuario->login ? 'selected' : '' }}>{{strtoupper($usuario->nome)}}</option>
                                @endforeach
                            @else
                                @foreach($usuarios as $usuario)
                                    <option value="{{$usuario->login}}" {{ old('usuario_login') == $usuario->login ? 'selected' : '' }}>{{strtoupper($usuario->nome)}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if($errors->has('usuario_login'))
                                <div class=" {{$errors->has('usuario_login') ? 'invalid-feedback' : ''}}">
                                    {{$errors->first('usuario_login')}}
                                </div>
                            @endif
                    </div>

                    <div class="col-2">
                        <label><b>Custo</b> </label>
                        <input  class="form-control {{ $errors->has('custo') ? 'is-invalid' : '' }}" type="text" name="custo"  id="custo" value="{{ old('meta', $meta->custo) }} ">
                        @if($errors->has('custo'))
                        <div class=" {{$errors->has('custo') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('custo')}}</div>
                        @endif
                    </div>


                </div>

                <input type="hidden" name="meta_id" id="meta_id" value={{$meta->meta_id}}>
                <input type="hidden" name="objetivo_id" id="objetivo_id" value={{$meta->objetivo_id}}>

                <div class="form-row mt-3">
                    <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold">Salvar</button>
                    <button type="reset" class="btn btn-outline-danger ml-2" style="font-size: 12px; font-weight: bold"
                    onclick="window.location.href='/objetivos/{{$objetivo->objetivo_id}}'">Cancelar </button>
                </div>

            </form>

</div>



@endsection
