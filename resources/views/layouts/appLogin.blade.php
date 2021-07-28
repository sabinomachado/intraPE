<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/product.css') }}" rel="stylesheet">

        <title>AAP- VR Intranet</title> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('/img/logo.png')}}" rel="icon">
        <link href="{{ asset('/img/logo.png')}}" rel="aapvr-icon">

       
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    </head>

    <body style="background-color:#00254d">
        <div class="container h-100" >
            <div class="row align-items-center h-100">
                <div class="col-md-6 mx-auto" >
                    <div class="card shadow-lg" style="background-color:#dee0e2; box-shadow: 0 12px 18px 0; transition: 0.8s;">

                        <img class="mb-2 login-form-image" src="{{ asset('img/logo_aapvr.png') }}" alt="">

                        <h4 class="mb-2 font-weight-normal text-center" sytle="font-weight:bold">Acesso</h4>
                        <div class="card-body col-md-8 mx-auto">

                            <main class="py-2">
                                @yield('content')
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="{{asset('js/util.js')}}"></script>

    </body>

    
</html>
