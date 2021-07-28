@extends('layouts.app2')

@section('content')
     <link rel=stylesheet href="{{ asset ('css/estrategico.css')}}"/>
     <link rel=stylesheet href="{{ asset ('css/home.css')}}">

    <div class="body">



        <div class="titulo">
            <h1>Painel de Planejamento Estratégico</h1>
        </div>

        <br>

        <div class="notice notice-info">
            <strong>Bem vindo,</strong> {{ Auth::user()->nome }}. Este é o seu painel estratégico! <br> 
           
        </div>

        <br>

        <div class="card-deck">
                <div class="card bg-light-gray border-primary text-primary">
                    <div class="card-body text-center">
                        <p class="card-text">Metas em Aberto <br> <h1>{{$metaAberta}}</h1> </p>
                    </div>
                </div>
                    <div class="card bg-light border-success text-success">
                    <div class="card-body text-center">
                        <p class="card-text">Metas Concluídas <br> <h1>{{$metaFechada}}</h1></p>
                    </div>
                </div>
                    <div class="card bg-light">
                    <div class="card-body text-center">
                        <p class="card-text">Próxima Reunião <br>

                        <h1>{{ isset($data) ? \Carbon\Carbon::parse($data)->format('d/m/Y') : '--/--/----'}}</h1></p>
                    </div>
                </div>

          </div>

          <br>

          <div class="card-group2">
            <div class="row">
                <div class="col-md-6 col-sm-4">
                        <div class="wrimagecard wrimagecard-topimage">
                            <a href="/perspectivas">
                            <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1) ">
                                <center><i class="fa fa-crosshairs" style="color:#BB7824"></i></center>
                        </div>

                        <div class="wrimagecard-topimage_title">
                            <h4>Perspectivas
                            <div class="pull-right badge"></div></h4>
                        </div>
                        </a>
                        </div>
                </div>

                <div class="col-md-6 col-sm-2">
                    <div class="wrimagecard wrimagecard-topimage">
                        <a href="/reunioes" >
                        <div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">
                            <center><i class = "fa fa-users" style="color:#16A085"></i></center>
                        </div>
                        <div class="wrimagecard-topimage_title">
                            <h4>Reunião
                            <div class="pull-right badge" id="WrControls"></div></h4>
                        </div>
                        </a>
                    </div>
                </div>





            </div>


            </div>
    </div>





@endsection
