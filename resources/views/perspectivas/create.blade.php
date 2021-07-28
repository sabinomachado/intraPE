@extends('layouts.app2')

@section('content')

<div class="container">
    <div class="col-md-12">
        <form action="{{ route('perspectivas.store') }}" class="form-horizontal" method="POST">
            @csrf
            <div class="titulo">
                <h1>Perspectiva </h1>
            </div>

            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif

                <div class="form-group ">

                    <label><b>Título</b> </label>
                    <input value="{{old('titulo')}}"class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" >
                    @if($errors->has('titulo'))
                    <div class=" {{$errors->has('titulo') ? 'invalid-feedback' : ''}}">
                        {{$errors->first('titulo')}}
                    </div>
                    @endif
                </div>

                <div class="form-group">

                        <label for="comment"><b>Descrição</b></label>
                <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" rows="5" id="descricao" >{{old('desscricao')}}</textarea>
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
                onclick="window.location.href='/perspectivas'">Cancelar </button>

            </div>



        </form>
    </div>
</div>

@endsection
