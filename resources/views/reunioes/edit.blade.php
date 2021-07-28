@extends('layouts.app2')

<div class="container">

    <form action="{{ route ('reunioes.update', ['reuniao' =>$reuniao->reuniao_id]) }}" class="form-horizontal" method="POST">
        @csrf
        @method('PUT')

    <div class='titulo'>
        <h1>Reunião</h1>
    </div>

    <br>

    <div class="form-group">
        <label>Título: </label>
        <input class="form-control" type="text" name="titulo"  id="titulo" value="{{ old('objetivo', $reuniao->titulo) }}" required>
    </div>

    <br>


    <div class="row">

        <div class="col-4 form-group">
            <label>Data da Reunião: </label>
            <input class="form-control" type="date" name="data"  id="data" value="{{ old('objetivo', $reuniao->data) }}" required>
        </div>

        <div class="col-2">
        </div>

        <div class="col-4 form-group">
            <label>Horário da Reunião: </label>
            <input class="form-control" type="time" name="hora_inicio"  id="hora_inicio" value="{{ old('objetivo', $reuniao->hora_inicio) }}"required>
        </div>

    </div>

    <div class="form-group">
        <label for="comment">Descrição:</label>
        <textarea class="form-control" type="text" name="descricao" rows="5" id="descricao" value="{{ old('objetivo', $reuniao->descricao) }}" required> </textarea>
    </div>


    <br>


    <div class="form-group">
        <button type="submit" class="btn btn-danger"> Editar Reunião </button>
    </div>


</form>

</div>


