<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link href="{{asset('css/front-style.css')}}?v=1" rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}?v=2">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css')}}?v=3">
        <script src="{{ asset('js/jquery.min.js') }}?v=4"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}?v=5"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> 

    </head>
    <body>
        <div class="container" >
            <div class="quiz-container " style="background-color: <?php  if(isset($data[0]->bgcolor)) { echo $data[0]->bgcolor; } ?>">
                 <button type="button" class="close" aria-label="Close" id="close-mod" style="margin-right: 40px;margin-top: 40px;font-size: 50px;">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="qc-table">
					         <div class="qc-tcell">
                        <div class="quix-box">
                            <div class="qb-header">
                                <h4><?php echo $data[0]->subtitle_1; ?></h4>
                                <p><?php echo $data[0]->subtitle_2; ?></p>
                            </div>
                            <input type="hidden" id="next" value="{{ url('/quizs_color/') }}"> 
                            <input type="hidden" id="previous" value="{{ url('/mmquiz/') }}"> 
                            <input type="hidden" id="quizId" value="<?php echo $quizId1; ?>">
                            <input type="hidden" id="nexturl" value="">
                            <div class="quiz-inner">
                                <div class="quiz-product">
                                    <div class="quiz-preview-container">
                                        <div class="preview0">
                                            <?php 
                                            $counts = count($frames);
                                            $url="https://www.mirrormate.com/collections/";
                                            if(!empty($frames)){
                                              for($k=0;$k<$counts;$k++) { 
                                                  $selectcolor = DB::select('select * from colors where select_frame_id='.$frames[$k]->id);
                                                  $selectcnt = count($selectcolor);
                                                  $redirect = "'".$url.$frames[$k]->handle."'";
                                                  ?>
                                                  <div class="quiz-pro-box" id="{{ $frames[$k]->id }}">
                                                       {{-- onclick="getSubFrame(@php echo $frames[$k]->id@endphp,@php echo $selectcnt@endphp,@php echo $redirect@endphp)" --}}
                                                      <div class="quiz-pro">
                                                          <div class="qpb-thumb" style="background-image: url('{{ $frames[$k]->frame_img }}');"></div>
                                                          <div class="qpb-inner">
                                                               <div class="custom-control custom-checkbox mr-sm-2">
                                                                  <input class="custom-control-input" type="checkbox" value="<?php echo $frames[$k]->id; ?>" name="checkbox" id="f_<?php echo $k; ?>"><label class="custom-control-label" for="f_<?php echo $k; ?>">{{ $frames[$k]->frame }}</label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                <?php } }else{ ?>
                                                      <div class="quiz-color-box">
                                                          <h4>Data Not Found</h4>
                                                      </div>
                                                <?php } ?>
                                        </div>
                                        <input type="hidden" id="fid" >
                                       <div class="steprow">
                                          <div class="step-col">
                                           <button id="btn3" class="btn btn" style="font-size:<?php if(isset($data[0]->next_fsize)) { echo $data[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($data[0]->next_btnbgcolor)) { echo $data[0]->next_btnbgcolor;} ?>;color:<?php if(isset($data[0]->next_btn_text_color)) { echo $data[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($data[0]->next_bradius)) { echo $data[0]->next_bradius; echo 'px'; }  ?>" onclick="previous();"><?php if(isset($data[0]->previous_btntext)) { echo $data[0]->previous_btntext; }  ?></button>
                                          <?php if(!empty($frames)){ ?>
                                           <button id="btn3" class="btn btn" style="font-size:<?php if(isset($data[0]->next_fsize)) { echo $data[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($data[0]->next_btnbgcolor)) { echo $data[0]->next_btnbgcolor;} ?>;color:<?php if(isset($data[0]->next_btn_text_color)) { echo $data[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($data[0]->next_bradius)) { echo $data[0]->next_bradius; echo 'px'; }  ?>" onclick="next();"><?php if(isset($data[0]->next_btntext)) { echo $data[0]->next_btntext; }  ?></button>
                                           <?php } ?>
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
    <script type="text/javascript">
        /*function getSubFrame(id,counts,url){
            jQuery('#'+id).addClass('active-div');
            
            if(counts==0){
                window.top.location =url;
            }else{
                var quizId = $('#quizId').val();
                window.location =jQuery('#next').val()+'/'+id+'/'+quizId;
                //alert(window.location);exit();
            }
        }*/

 

         function previous(){
            var quizId = $('#quizId').val();
            window.location =jQuery('#previous').val()+'/'+quizId;
        }

        function next(){ 
            var fid = $('#fid').val(); 
            if(fid == ''){
                alert('Please Select at least 1 Frame');
                return false;
            } 
            var quizId = $('#quizId').val();
            var select_fid = $('#fid').val();
            window.location =jQuery('#next').val()+'/'+select_fid+'/'+quizId;
           
        }

        $("#close-mod").click(function() {
            window.top.location = 'https://mirrormatellc.myshopify.com/';
        });


          var tmp = [];
          $("input[name='checkbox']").change(function() {
            var checked = $(this).val();
            //var url = 'https://www.mirrormate.com/collections/all-frames?';
              if ($(this).is(':checked')) { 
                tmp.push(checked);
                //console.log(tmp);
                
              }else{
              tmp.splice($.inArray(checked, tmp),1);
               console.log(tmp);
              }
              $('#fid').val(tmp);
             

          });

       /* function next(){
            var url = $('#next').val();
            var select_fid = $('#fid').val();
             var quizId = $('#quizId').val();
             alert(quizId);
            $.ajax({
                url: url,
                type: "POST",
                dataType: "html",
                data: {
                 _token: "{{ csrf_token() }}",
                 Fid:select_fid,
                 quizId:quizId  
               },
               cache: false,
               success: function(data){ 
               window.location =jQuery('#next').val();   
               }
             });
        }*/

        $(document).ready( function(){
          function equalHeight(){
              var heightArray = $(".quiz-pro").map( function(){
                       return  $(this).height();
                       }).get();
              var maxHeight = Math.max.apply( Math, heightArray);
              $(".quiz-pro").height(maxHeight);
                  }
          equalHeight();
         });
    </script>
</html>


