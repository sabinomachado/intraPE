@extends('layouts.appLogin')


{{-- @extends('layouts.login',["current" => "index"]) --}}

@section('content')
  <div class="container">
    <form method="POST" action="{{ route('login') }}">
        @csrf

      
        <div class="form-group row">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="text" id="login" name="login" class="form-control"
                        placeholder="Login" aria-label="Login"
                        aria-describedby="login" value="{{old('login')}}"required>
            </div>

            @if ($errors->has('login'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('login') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group row">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">#</span>
                </div>

                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Senha" aria-label="Senha" aria-describedby="Senha" required>
                </div>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
        </div>

        @if(!empty($errors->first()))
            <div class="input-group mb-3" id="mensagem-erro" name="mensagem-erro">
                <div class="alert alert-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <div class="form-group row mb-0">
            <div class="form-group col-md-10">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </div>
        </div>
    </form>
  </div>
@endsection
