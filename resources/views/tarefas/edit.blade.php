@extends('layouts.app2')

@section('content')
<link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
<link rel=stylesheet href="{{ asset ('css/estrategico.css')}}"/>




<div class="container">

    <form action="{{ route('tarefas.update', ['acao' =>$acao, 'tarefa' =>$tarefa->tarefa_id]) }}" class="form-horizontal" method="POST">
      @csrf
      @method('PUT')

        <div class="titulo">
            <h1>Tarefa </h1>
        </div>

        <div class="notice notice-blue">


            <strong>  Ação: </strong>

                    {{$acao->descricao}} 
            <br>
            <strong> Prazo Final(Ação):  </strong>  {{  \Carbon\Carbon::parse($acao->data_fim_previsto)->format('d/m/Y')   }}
           
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
            <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" rows="5" id="descricao"> {{old('acao', $tarefa->descricao) }}</textarea>
            @if($errors->has('descricao'))
            <div class=" {{$errors->has('descricao') ? 'invalid-feedback' : ''}}">
                {{$errors->first('descricao')}}
            </div>
            @endif
        </div>

        <div class="row">
         
           
                <div class="col-2 form-group">
                    <label><b>Início Previsto</b></label>
                    <input class="form-control {{ $errors->has('data_inicio_previsto') ? 'is-invalid' : '' }}" type="date" name="data_inicio_previsto"  id="data_inicio_previsto"   value="{{old('tarefa', $tarefa->data_inicio_previsto) }}" >
                    @if($errors->has('data_inicio_previsto'))
                        <div class=" {{$errors->has('data_inicio_previsto') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('data_inicio_previsto')}}
                        </div>
                    @endif
                </div>

                <div class="col-2 form-group">
                    <label><b>Fim Previsto</b> </label>
                    <input class="form-control {{ $errors->has('data_fim_previsto') ? 'is-invalid' : '' }}" type="date" name="data_fim_previsto"  id="data_fim_previsto" value="{{old('tarefa', $tarefa->data_fim_previsto) }}" >
                    @if($errors->has('data_fim_previsto'))
                        <div class=" {{$errors->has('data_fim_previsto') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('data_fim_previsto')}}
                        </div>
                    @endif
                </div>
           
           
               
                
                <div class="col-4 form-group">
                    <label><b>Responsável</b> </label>
                  
                        <select aria-disabled="true" class="form-control {{ $errors->has('usuario_login') ? 'is-invalid' : '' }}" name="usuario_login" id="usuario_login" >
                            @if(old('usuario_login') == null)
                                @foreach($usuarios as $usuario)
                                    <option aria-disabled="true" value="{{$usuario->login}}" {{ $tarefa->usuario_login == $usuario->login ? 'selected' : '' }}>{{strtoupper($usuario->nome)}}</option>
                                @endforeach
                            @else
                                @foreach($usuarios as $usuario)
                                    <option aria-disabled="true" value="{{$usuario->login}}" {{ old('usuario_login') == $usuario->login ? 'selected' : '' }}>{{strtoupper($usuario->nome)}}</option>
                                @endforeach
                            @endif
                        </select>
                            @if($errors->has('usuario_login'))
                            <div class=" {{$errors->has('usuario_login') ? 'invalid-feedback' : ''}}">
                                {{$errors->first('usuario_login')}}</div>
                            @endif
                    
               
                </div>
               
                

                <div class="col-2 form-group">
                    <label for="custo"><b>Custo</b></label>
                    <input value="{{old('custo', $tarefa->custo) }}" class="form-control {{ $errors->has('custo') ? 'is-invalid' : '' }}" type="number" name="custo" id="custo" ></input>
                    @if($errors->has('custo'))
                        <div class=" {{$errors->has('custo') ? 'invalid-feedback' : ''}}">
                            {{$errors->first('custo')}}
                        </div>
                    @endif
                </div>

                <div class="col-2 form-group">
                    <label for="andamento"><b>Andamento</b></label>
                    <select class="form-control" name="andamento" id="andamento" >
                        <option value="0" {{ $tarefa->andamento == "0" ? 'selected' : ''}}>0</option>
                        <option value="25" {{ $tarefa->andamento == "25" ? 'selected' : ''}}>25</option>
                        <option value="50" {{ $tarefa->andamento == "50" ? 'selected' : ''}}>50</option>
                        <option value="75" {{ $tarefa->andamento == "75" ? 'selected' : ''}}>75</option>
                        <option value="100" {{ $tarefa->andamento == "100" ? 'selected' : ''}}>100</option>
                    </select>
                </div>
            
            
        </div>

        

        <br>


        <input type="hidden" name="acao_id" id="acao_id" value={{ $tarefa->acao_id }}>
        <input type="hidden" name="tarefa_id" id="tarefa_id" value={{ $tarefa->tarefa_id }}>

        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold">Salvar</button>
            <button type="reset" class="btn btn-outline-danger ml-2" style="font-size: 12px; font-weight: bold"
            onclick="window.location.href='/acoes/{{$tarefa->acao_id}}'">Cancelar </button>

        </div>




    </form>

</div>

@endsection
