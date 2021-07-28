@extends('layouts.app2')

@section('content')

<div class="container">

        <form action="{{ route('reunioes.store') }}" class="form-horizontal" method="POST">
         @csrf

        <div class='titulo'>
            <h1>Reunião</h1>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif

        <br>

        <div class="form-group">
            <label>Título: </label>
            <input value="{{old('titulo')}}" class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo"  id="titulo" >
            @if($errors->has('titulo'))
            <div class=" {{$errors->has('titulo') ? 'invalid-feedback' : ''}}">
                {{$errors->first('titulo')}}
            </div>
            @endif

        </div>

        <br>


        <div class="row">

            <div class="col-4 form-group">
                <label>Data da Reunião: </label>
                <input value="{{old('data')}}" class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" type="date" name="data"  id="data" >
                @if($errors->has('data'))
                <div class=" {{$errors->has('data') ? 'invalid-feedback' : ''}}">
                    {{$errors->first('data')}}
                </div>
                @endif
            </div>

            <div class="col-2">
            </div>

            <div class="col-4 form-group">
                <label>Horário da Reunião: </label>
                <input value="{{old('hora_inicio')}}" class="form-control {{ $errors->has('hora_inicio') ? 'is-invalid' : '' }}" type="time" name="hora_inicio"  id="hora_inicio" >
                @if($errors->has('hora_inicio'))
                <div class=" {{$errors->has('hora_inicio') ? 'invalid-feedback' : ''}}">
                    {{$errors->first('hora_inicio')}}
                </div>
                @endif
            </div>

        </div>

        <div class="form-group">
            <label for="comment">Descrição:</label>
            <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" rows="5" id="descricao" > {{old('descricao')}}</textarea>
            @if($errors->has('descricao'))
            <div class=" {{$errors->has('descricao') ? 'invalid-feedback' : ''}}">
                {{$errors->first('descricao')}}
            </div>
            @endif
        </div>


        <br>

        <div class="form-row mt-3">
            <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold">Salvar</button>
            <button type="reset" class="btn btn-outline-danger ml-2" style="font-size: 12px; font-weight: bold"
            onclick="window.location.href='/reunioes'">Cancelar</button>
        </div>



    </form>

</div>

@endsection
