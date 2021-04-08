<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        <title>Laravel</title>

        <!-- Fonts -->
       {{--  <link href="https://<fieldset></fieldset>onts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

        <link href="{{asset('css/front-style.css')}}" rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css')}} ">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
     

    </head>
    <body>
		<input type="hidden" id="quiz" value="{{ url('/mmquiz/next') }}">
        <input type="hidden" id="quizId" value="<?php echo $quizId; ?>">
		<div class="container" >
			<div class="quiz-container" style="background-color: <?php  if(isset($data[0]->bgcolor)) { echo $data[0]->bgcolor; } ?>">
				 <button type="button" class="close" aria-label="Close" id="close-mod" style="margin-right: 40px;margin-top: 40px;font-size: 50px;">
                  <span aria-hidden="true">&times;</span>
                </button>
				<div class="qc-table">
					<div class="qc-tcell">
						<div class="centered qc-first">
                             <div class="qb-header">    
    							<h4><?php if(isset($data[0]->title_1)) { echo $data[0]->title_1; }  ?></h4>
    							<p><?php if(isset($data[0]->title_2)) { echo $data[0]->title_2; }  ?></p>
                            </div>
							<div class="qc-button">
								<input type="button" value="<?php if(isset($data[0]->btn_text)) { echo $data[0]->btn_text; }  ?>" style="width:200px;height:40px;background-color:<?php if(isset($data[0]->btn_bgcolor)) { echo $data[0]->btn_bgcolor; }  ?>;color:<?php if(isset($data[0]->btn_txtcolor)) { echo $data[0]->btn_txtcolor; }  ?>;font-size:<?php if(isset($data[0]->btn_font_size)) { echo $data[0]->btn_font_size.'px'; }  ?>;border-radius: <?php if(isset($data[0]->btn_border_radius)) { echo $data[0]->btn_border_radius.'px'; }  ?>" id="start1" name="start1" onclick="ColorSelection();">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>

</html>
<script>
 function ColorSelection(){
    next_url = $('#quiz').val();
    quizId = $('#quizId').val();
    var url = next_url+'/'+quizId;

    window.location = url;
 }
 
 jQuery(document).ready(function(){
 $("#close-mod").click(function() {
   //alert(document.domain);
    window.top.location = 'https://www.mirrormate.com/';
});
});
</script>