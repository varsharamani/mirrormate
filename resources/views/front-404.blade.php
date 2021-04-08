<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        <title>Laravel</title>

        <!-- Fonts -->
      
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

        <link href="{{ asset('css/front-style.css') }}" rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }} ">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <style>
            .quiz-container {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                overflow-y: auto;
                overflow-x: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>

    </head>
    <body>
		
		<div class="container" >
             <button type="button" class="close" aria-label="Close" id="close-mod" style="margin-right: 40px;margin-top: 40px;font-size: 50px;">
                  <span aria-hidden="true">&times;</span>
                </button>
			<div class="quiz-container">
				 <h5 style="text-align: center;">This Quiz is not available..</h5>
			</div>
		</div>
    </body>

</html>
<script>
	 $("#close-mod").click(function() {
         window.top.location = 'https://mirrormate-staging.myshopify.com/';
    });
</script>