@extends('layouts.app2')

@section('content')
<link rel=stylesheet href="{{ asset ('css/home.css')}}">
<link rel=stylesheet href="{{ asset ('css/planejamento.css')}}"/>
<link rel=stylesheet href="{{ asset ('css/estrategico.css')}}"/>

<div class="carousel">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
              <a href="https://www.aapvr.org.br/covid" target="_blank">
                 <img class="d-block w-100 img-fluid" src="{{  asset('img/corona.jpg') }}" alt="First slide" href="www.globo.com">
              </a>
          </div>
          <div class="carousel-item item">

                 <img class="d-block w-100" src="{{  asset('img/colaborador.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <a href="https://radioaapvr.webradiosite.com/noticias/" target="_blank">
                 <img class="d-block w-100" src="{{  asset('img/radio.jpg') }}" alt="Third slide">
            </a>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</div>
<br>

    <div class="card-aviso card">

      <div class="card-body">
        Seja bem vindo <b>{{ Auth::user()->nome }}</b>! <br>
        <!--<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar3-event" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
          <path fill-rule="evenodd" d="M12 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </svg> - {{$mensagemAniversario}}-->

        <div class="row" style="margin-top: 10px; margin-left: 10px">
          <div class="col-4">
            <img  class="tamanho-icone-mensagem" src="{!! asset('img/svg/cake.svg') !!}";>{{$mensagemAniversario}}
          </div>

          <div class="col-4">
            <img  class="tamanho-icone-mensagem" src="{!! asset('img/svg/vacation.svg') !!}";>{{$mensagemFerias}}
          </div>

          <div class="col-4">
            <img  class="tamanho-icone-mensagem" src="{!! asset('img/svg/history.svg') !!}";>{{$mensagemFerias}}
          </div>
        </div>






      </div>
    </div>

<br>

  <div class="msg" id="accordionOne" style="display: {{$displayAniversario}};">
        <div class="card">
              <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          Seja bem vindo <b>{{ Auth::user()->nome }}</b>, você tem uma nova mensagem!
                      </button>
                  </h5>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionOne">
                  <div class="card-body">
                  {{$mensagemAniversario}}
                  <br>
                  </div>
              </div>
        </div>
  </div>

  <br>

  <div class="msg" id="accordionTwo" style="display: {{$displayFerias}};">
        <div class="card">
              <div class="card-header" id="headingTwo">
                  <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Seja bem vindo <b>{{ Auth::user()->nome }}</b>, você tem uma nova mensagem!
                      </button>
                  </h5>
              </div>

              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionTwo">
                  <div class="card-body">
                  {{$mensagemFerias}}
                  <br>
                  </div>
              </div>
        </div>
</div>

<br>


        <div class="card-group">
            <div class="row">

                    <div class="col-md-4 col-sm-4">
                        <div class="wrimagecard wrimagecard-topimage">
                            <a href="/estrategico">
                            <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1) ">
                                <center><i class="fa fa-area-chart" style="color:#BB7824"></i></center>
                            </div>
                            <div class="wrimagecard-topimage_title">
                                <h4>Planejamento Estratégico
                                <div class="pull-right badge"></div></h4>
                            </div>
                            </a>
                        </div>
                    </div>


                <div class="col-md-4 col-sm-4">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="/rh.aapvr.com.br" target="_blank">
                    <div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">
                        <center><i class = "fa fa-users" style="color:#16A085"></i></center>
            </div>

            <div class="wrimagecard-topimage_title">
                        <h4>RH
                        <div class="pull-right badge" id="WrControls"></div></h4>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            <div class="wrimagecard wrimagecard-topimage">
                <a href="financeiro.aapvr.com.br">
                <div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">
                    <center><i class="fa fa-money" style="color:#d50f25"> </i></center>
                </div>
                <div class="wrimagecard-topimage_title" >
                    <h4>Financeiro
                    <div class="pull-right badge" id="WrForms"></div>
                    </h4>
                </div>

                </a>
            </div>
            </div>

      <div class="col-md-4 col-sm-4">
          <div class="wrimagecard wrimagecard-topimage">
              <a href="#">
                <div class="wrimagecard-topimage_header" style="background-color: rgba(121, 90, 71, 0.1)">
              <center><i class="fa fa-balance-scale" style="color:#795a47"> </i></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4>Regimento Interno
                <div class="pull-right badge" id="WrNavigation"></div></h4>
              </div>

            </a>
          </div>
      </div>
      <div class="col-md-4 col-sm-4">
          <div class="wrimagecard wrimagecard-topimage">
              <a href="#">
            <div class="wrimagecard-topimage_header" style="background-color: rgba(130, 93, 9, 0.1)">
                <center><i class="fa fa-book" style="color:#825d09"></i></center>
              </div>
              <div class="wrimagecard-topimage_title">
                <h4>Documentos
                <div class="pull-right badge" id="WrThemesIcons"></div></h4>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="wrimagecard wrimagecard-topimage">
                <a href="#">
              <div class="wrimagecard-topimage_header" style="background-color: rgba(130, 93, 9, 0.1)">
                  <center><i class="fa fa-archive" style="color:#825d09"></i></center>
                </div>
                <div class="wrimagecard-topimage_title">
                  <h4>Material de Apoio
                  <div class="pull-right badge" id="WrThemesIcons"></div></h4>
                </div>
              </a>
            </div>
          </div>



    </div>
</div>

@endsection
