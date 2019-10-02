<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Labx</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/extra.css') }}" rel="stylesheet">
    </head>
    <body class="homeBg" style="background-image:url({{ asset('images/background/home.jpg')}});">
        <div class="content">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-md-3">
                    <div class="d-flex  align-items-center w-100">
                        <div class="card w-100 py-5" id="home">
                            <div class="card-body">
                                <div class="pb-3">
                                    <h1 class="text-center">LABX</h1>
                                </div>
                                <hr>
                                <div class="text-center pt-3">
                                    <a href="{{ route('login') }}" class="btn btn-secondary">Ingresar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
