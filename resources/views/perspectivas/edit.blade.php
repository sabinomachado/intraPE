@extends('layouts.app2')

@section('content')

<div class="container">
    <div class="col-md-12">
        <form action="{{ route('perspectivas.update', ['perspectiva' => $perspectiva->perspectiva_id]) }}" class="form-horizontal" method="POST">
            @csrf
            @method('PUT')

            <div class="body">

                <div class="titulo">
                    <h1>Perspectivas </h1>
                </div>

                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif


                        <div class="row">
                            <div class="form-group">
                                <label><b>Título</b> </label>
                            <input  class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}"type="text" size="200"  name="titulo" value="{{ old('perspectiva', $perspectiva->titulo) }}">
                            @if($errors->has('titulo'))
                            <div class=" {{$errors->has('titulo') ? 'invalid-feedback' : ''}}">
                                {{$errors->first('titulo')}}
                            </div>
                            @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label><b>Descrição</b> </label>
                            <textarea  class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" rows="3" cols="150"   name="descricao" >{{ old('perspectiva', $perspectiva->descricao) }}</textarea>
                            @if($errors->has('descricao'))
                            <div class=" {{$errors->has('descricao') ? 'invalid-feedback' : ''}}">
                                {{$errors->first('descricao')}}
                            </div>
                            @endif
                        </div>
                        </div>

                        <br>

                        <div class="form-row mt-3">
                            <button type="submit" class="btn btn-primary" style="font-size: 12px; font-weight: bold"  onclick="window.location.href='/perspectivas'">Salvar</button>
                            <button type="reset" class="btn btn-outline-danger ml-2" style="font-size: 12px; font-weight: bold"  onclick="window.location.href='/perspectivas'">Cancelar</button>
                        </div>

                    </form>
            </div>
    </div>
</div>

@endsection
