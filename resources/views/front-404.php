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
     

    </head>
    <body>
		
		<div class="container" >
			<div class="quiz-container">
				 <h5 style="text-align: center">This Site is not available..</h5>
			</div>
		</div>
    </body>

</html>
<script>
	/*jQuery( document ).ready(function() {
		alert(jQuery('#main-div').html());
		jQuery('#main-div').css('background-color','#fff');
	});*/
</script>