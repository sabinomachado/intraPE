@extends('layouts.app2')

@section('content')
<link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
<link rel=stylesheet href="{{ asset ('css/estrategico.css')}}"/>




<div class="container">

    <form action="{{ route('acoes.store') }}" class="form-horizontal" method="POST">
      @csrf

        <div class="titulo">
            <h1>Ações </h1>
        </div>



        <div class="notice notice-info">


            <strong>  Meta: </strong>

                    @foreach ($meta as $mt)
                    {{ $mt->titulo }}
                    <br>
                    @endforeach

            <strong> Prazo Final:  </strong>  {{  \Carbon\Carbon::parse($mt->data_fim_previsto)->format('d/m/Y')   }}
            <br>
            <strong> Valor Orçado: </strong> R${{ number_format($mt->custo, 2, ',', '.') }}
           
        </div>


        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif


        <div class="form-group">
            <label for="comment"><b>Descrição</b></label>
        <textarea value="{{old('descricao')}}" class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" rows="5" id="descricao">{{old('descricao')}} </textarea>
                @if($errors->has('descricao'))
                    <div class=" {{$errors->has('descricao') ? 'invalid-feedback' : ''}}">
                        {{$errors->first('descricao')}}</div>
                @endif
        </div>


        <div class="row">
            <div class="col-3 form-group">
                    <label><b>Início Previsto</b> </label>
                    <input value="{{old('data_inicio_previsto')}}" class="form-control {{ $errors->has('data_inicio_previsto') ? 'is-invalid' : '' }}" type="date" name="data_inicio_previsto"  id="data_inicio_previsto" >
                    @if($errors->has('data_inicio_previsto'))
                    <div class=" {{$errors->has('data_inicio_previsto') ? 'invalid-feedback' : ''}}">
                        {{$errors->first('data_inicio_previsto')}}</div>
                    @endif
            </div>

            <div class="col-3 form-group">
                    <label><b>Fim Previsto</b> </label>
            <input value="{{old('data_fim_previsto')}}" class="form-control {{ $errors->has('data_fim_previsto') ? 'is-invalid' : '' }}" type="date" name="data_fim_previsto"  id="data_fim_previsto" >
                    @if($errors->has('data_fim_previsto'))
                    <div class=" {{$errors->has('data_fim_previsto') ? 'invalid-feedback' : ''}}">
                        {{$errors->first('data_fim_previsto')}}</div>
                    @endif
            </div>

            
            @if(Auth::user()->getPrivilegio->nivel == 'Administrador')
                    <div class="col-4 form-group">
                        <label for="usuario_login"><b>Usuário Responsável</b> </label>
                        <select class="form-control {{ $errors->has('usuario_login') ? 'is-invalid' : '' }}" name="usuario_login" id="usuario_login" >
                                    <option value="null">Selecione...</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{$usuario->login}}" {{ old('usuario_login') == $usuario->login ? 'selected' : '' }}>{{strtoupper($usuario->nome)}}</option>
                                @endforeach
                        </select>
                            @if($errors->has('usuario_login'))
                        <div class=" {{$errors->has('usuario_login') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('usuario_login')}}
                        </div>
                            @endif
                    </div>
                @else
                    
                <div class="col-4 form-group">
                        <label><b>Responsável</b> </label>
                    
                        <select  readonly class="form-control {{ $errors->has('usuario_login') ? 'is-invalid' : '' }}" name="usuario_login" id="usuario_login" >
                            <option  value={{$user->login}} {{ old('usuario_login') == $user->login ? 'selected' : '' }}>{{strtoupper($user->nome)}}</option>
                               
                        </select>
                        @if($errors->has('usuario_login'))
                        <div class=" {{$errors->has('usuario_login') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('usuario_login')}}</div>
                        @endif
                        
                
                    </div>
            @endif
           
            
            

            <div class="col-2 form-group">
                        <label for="comment"><b>Custo</b></label>
                        <input value="{{old('custo')}}" class="form-control {{ $errors->has('custo') ? 'is-invalid' : '' }}" type="number" name="custo" rows="1" id="custo" ></textarea>
                        @if($errors->has('custo'))
                        <div class=" {{$errors->has('custo') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('custo')}}
                        </div>
                        @endif
            </div>

        </div>

        <input type="hidden" name="meta_id" id="meta_id" value={{ $mt->meta_id }}>

        <br>



        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold">Salvar</button>
            <button type="reset" class="btn btn-outline-danger ml-2" style="font-size: 12px; font-weight: bold"
            onclick="window.location.href='/metas/{{$mt->meta_id}}'">Cancelar</button>
        </div>


    </form>

</div>

@endsection
