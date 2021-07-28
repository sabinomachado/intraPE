@extends('layouts.app2')

@section('content')

<div class="container">
    <div class="col-md-12">
        <form action="{{ route('objetivos.update', [ 'objetivo' => $objetivo->objetivo_id]) }}" class="form-horizontal" method="POST">
            @csrf
            @method('PUT')



                <div class="titulo">
                    <h1>Objetivos </h1>
                </div>

                <div class="notice notice-blue">


                    <strong>  Perspectiva: </strong>

                            {{$perspectiva->titulo}}
                    <br>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif


                </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label><b>Descrição</b></label>
                           <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" rows="5" id="descricao" >{{ old('objetivo', $objetivo->descricao) }}</textarea> 
                            @if($errors->has('descricao'))
                                    <div class=" {{$errors->has('descricao') ? 'invalid-feedback' : ''}}">
                                        {{$errors->first('descricao')}}
                                    </div>
                                 @endif
                            </div>
                        </div>


                        <br>
                         

                            <div class="row">
                                

                                <div class="form-group col-4 ">
                                    <label><b>Início</b> </label>
                                    <input  class="form-control {{ $errors->has('data_inicio') ? 'is-invalid' : '' }}" type="date" name="data_inicio"  id="data_inicio" value="{{old('objetivo', $objetivo->data_inicio) }}" >
                                        @if($errors->has('data_inicio'))
                                            <div class=" {{$errors->has('data_inicio') ? 'invalid-feedback' : ''}}">
                                                {{$errors->first('data_inicio')}}
                                            </div>
                                        @endif
                                </div>
    
                                <div class="form-group col-4 ">
                                    <label><b>Fim Previsto</b> </label>
                                    <input  class="form-control {{ $errors->has('data_fim') ? 'is-invalid' : '' }}" type="date" name="data_fim"  id="data_fim" value="{{old('objetivo', $objetivo->data_fim) }}">
                                        @if($errors->has('data_fim'))
                                            <div class=" {{$errors->has('data_fim') ? 'invalid-feedback' : ''}}">
                                                {{$errors->first('data_fim')}}
                                            </div>
                                         @endif
                                </div>

                                <div class="form-group col-4">
                                    <label><b>Custo (R$)</b> </label>
                                    <input class="form-control {{ $errors->has('custo_objetivo') ? 'is-invalid' : '' }}" type="number" name="custo_objetivo"  id="custo_objetivo" value="{{old('objetivo', $objetivo->custo_objetivo) }}">
                                    @if($errors->has('custo_objetivo'))
                                        <div class=" {{$errors->has('custo_objetivo') ? 'invalid-feedback' : ''}}">
                                            {{$errors->first('custo_objetivo')}}
                                        </div>
                                     @endif
                            </div>


                        </div>

                        <input type="hidden" name="perspectiva_id" id="perspectiva_id" value={{$objetivo->perspectiva_id}}>

                        <br>

                         <div class="form-row mt-3">
                            <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold">Salvar</button>
                            <button type="reset" class="btn btn-outline-danger ml-2" style="font-size: 12px; font-weight: bold"  onclick="window.location.href='/perspectivas/{{$perspectiva->perspectiva_id}}'">Cancelar</button>
                        </div>
                </form>
            </div>
    </div>




@endsection
