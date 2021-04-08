<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link href="{{asset('css/front-style.css')}}" rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css')}} ">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    </head>
    <body>
         <div id="app">
            <div class="container" >
                <div class="quiz-container" style="background-color: <?php  if(isset($data[0]->bgcolor)) { echo $data[0]->bgcolor; } ?>">
                     <button type="button" class="close" aria-label="Close" id="close-mod" style="margin-right: 40px;margin-top: 40px;font-size: 50px;">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="qc-table">
					    <div class="qc-tcell">
                            <div class="quix-box">
                                <div class="qb-header">
                                   
                                    <h4><?php echo $choose; ?></h4>
                                    
                                </div>
                                 <input type="hidden" id="previous" value="{{ url('/quizs_color/') }}">
                                 <input type="hidden" id="allframe" value="<?php echo $allframe; ?>">
                                 <input type="hidden" id="quizId" value="<?php echo $quizId1; ?>">
                                <div class="quiz-inner">
                                    <div class="quiz-product">
                                        <div class="quiz-preview-container">
                                            <div class="quiz-list-box quiz-color preview0">
                                                <?php

                                                $url="https://mirrormate-staging.myshopify.com/collections/";
                                                $counts = count($selectFramecolor);
                                                if(!empty($selectFramecolor)){
                                                for($k=0;$k<$counts;$k++) { 
                                                    $redirect = "'".$url.$selectFramecolor[$k]->handle."'";
                                                    ?>

                                                    <div class="quiz-color-box" id="{{ $selectFramecolor[$k]->id }}">
                                                        <div class="quiz-pro-color" onclick="callredirect(@php echo $selectFramecolor[$k]->id@endphp,@php echo $redirect@endphp)">
                                                            <div class="qpc-thumb" style="background-image: url('{{ $selectFramecolor[$k]->frame_img }}');"></div>
                                                            <div class="qpc-inner">
                                                                 <span class="qpc-radio"></span>
                                                                <span class="qpc-title">{{ $selectFramecolor[$k]->frame }}</span> 
                                                                 
                                                                <!--  <div class="custom-control custom-checkbox mr-sm-2">
                                                                      <input class="custom-control-input" type="checkbox" value="" name="checkbox" id="col_<?php echo $k; ?>"><label class="custom-control-label" for="col_<?php echo $k; ?>">{{ $selectFramecolor[$k]->frame }}</label>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } }else{  ?>
                                                     <div class="quiz-color-box">
                                                            <h4>Data Not Found</h4>
                                                     </div>
                                                <?php } ?>
                                            </div>
                                            <div class="steprow">
                                                <div class="text-left">
                                                   <button id="btn3" class="btn btn" style="font-size:<?php if(isset($data[0]->next_fsize)) { echo $data[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($data[0]->next_btnbgcolor)) { echo $data[0]->next_btnbgcolor;} ?>;color:<?php if(isset($data[0]->next_btn_text_color)) { echo $data[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($data[0]->next_bradius)) { echo $data[0]->next_bradius; echo 'px'; }  ?>" onclick="Previous();"><?php if(isset($data[0]->previous_btntext)) { echo $data[0]->previous_btntext; }  ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
     function Previous(){
            var quizId = $('#quizId').val();
            var allframe = $('#allframe').val();
            window.location =jQuery('#previous').val()+'/'+allframe+'/'+quizId;
        }

    function callredirect(id,url){
        jQuery('#'+id).addClass('active-div');
        setTimeout(function(){
            window.top.location =  url;
        },1000);
    }

    $( "#close-mod" ).click(function() {
            window.top.location = 'https://mirrormate-staging.myshopify.com/';
        });
</script>

