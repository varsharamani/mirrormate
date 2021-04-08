<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
       {{--  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

        <link href="{{asset('resources/css/style.css')}}">
        <!-- Styles -->
        
    </head>
    <body>
       <div id="app">
        <div class="container">
            <Home></Home>
        </div>
       </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('resources/js/jquery.min.js') }}"></script>
        <script src="{{ asset('resources/js/Sortable.js') }}"></script>
        <script src="{{ asset('resources/js/custom.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>  
    </body>
</html>
