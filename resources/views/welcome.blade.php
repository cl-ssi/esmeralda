<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('SERVICIO','Configurar variable SERVICIO en .env') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .servicio {
                color: #636b6f;
                padding: 0 25px;
                font-size: 28px;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

		<link href="{{ asset('css/alert.css') }}" rel="stylesheet">
        <link href="{{ asset('css/cu.min.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesión</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Esmeralda
                </div>

                <div class="servicio m-b-md">
                    {{ env('SERVICIO','Configurar variable SERVICIO en .env') }}
                </div>

                <br>

                <!--
                <h2 class="flex-center">Resultado de exámenes</h2>
                
                <div class="flex-center">
                    <a class="btn-cu btn-m btn-color-estandar" href="{{ route('examenes.autenticar') }}" title="Este es el botón Iniciar sesión de ClaveÚnica">
                        <span class="cl-claveunica"></span>
                        <span class="texto">Iniciar sesión</span>
                    </a>
                    
                </div>
                -->

                <br> <br> <br> 
				
				@foreach (['danger', 'warning', 'success', 'info'] as $key)
                    @if(session()->has($key))
                    <div class="alert alert-{{ $key }} alert-dismissable">
                        <h3>{!! session()->get($key) !!}</h3>
                    </div>
                    @endif
                @endforeach
				
				<br> <br> <br>



                <div class="links">
                    <a href="https://www.minsal.cl">Minsal</a>
                    <a href="https://www.gob.cl/coronavirus/">Coronavirus</a>
                </div>

                <img src="https://cdn.digital.gob.cl/filer_public/bd/1f/bd1f2309-ac14-447e-8aae-ec7228bee7b2/logo-gob-footer.png"
                    width="150px" alt="Gobierno de Chile"> 

                <p>{{ date('Y') }} Gobierno de Chile.</p>

            </div>


        </div>

    </body>
</html>
