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
                                    <p><?php echo $data[0]->sec_title_2; ?></p> 
                                
                                </div>
                                <input type="hidden" id="next" value="{{ url('/finish_Quiz') }}"> 
                                 <input type="hidden" id="previous" value="{{ url('/mmquiz/next') }}"> 
                                <input type="hidden" id="quizId" value="<?php echo $quizId; ?>">
                                <input type="hidden" id="allframe" value="<?php echo $Fid; ?>">
                                <input type="hidden" id="nexturl" value="<?php echo $finalUrl; ?>">
                                <input type="hidden" id="whereC" value="<?php echo $whereC; ?>">
                                <input type="hidden" id="whereP" value="<?php echo $whereP; ?>">
                                <input type="hidden" id="whereD" value="<?php echo $whereD; ?>">
                                <input type="hidden" id="whereFW" value="<?php echo $whereFW; ?>">
                                <input type="hidden" id="whereFN" value="<?php echo $whereFN; ?>">
                                <div class="quiz-inner">
                                    <div class="quiz-product">
                                        <div class="quiz-preview-container">
                                            <div class="quiz-list-box quiz-color preview0">
                                                
                                                <?php
                                                $url="https://mirrormate-staging.myshopify.com/collections/";
                                                $counts = count($selectcolor);
                                                if(!empty($selectcolor)){
                                                    for($k=0;$k<$counts;$k++) { 
                                                        $selectFramecolor = DB::select('select * from frame_cols where sel_color_id='.$selectcolor[$k]->id.' and sel_frame_id = '.$selectcolor[$k]->select_frame_id);
                                                       // print_r($selectFramecolor);die;
                                                        $selectcnt = count($selectFramecolor);
                                                        $redirect = "'".$url.$selectcolor[$k]->handle."'";
                                                        ?>

                                                        <div class="quiz-color-box" id="{{ $selectcolor[$k]->id }}">
                                                            {{--  onclick="getSubFrame(@php echo $selectcolor[$k]->id@endphp,@php echo $selectcolor[$k]->select_frame_id@endphp,@php echo $selectcnt @endphp,@php echo $redirect@endphp)" --}}
                                                            <div class="quiz-pro-color">
                                                                <div class="qpc-thumb" style="background-image: url('{{ $selectcolor[$k]->frame_img }}');"></div>
                                                                <div class="qpc-inner">
                                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                                          <input class="custom-control-input" type="checkbox" value="<?php echo $selectcolor[$k]->frame_id; ?>" name="checkbox" id="c_<?php echo $k; ?>" data-id="<?php echo $selectcolor[$k]->id; ?>"><label class="custom-control-label" for="c_<?php echo $k; ?>">{{ $selectcolor[$k]->frame }}</label>
                                                                    </div>
                                                                    {{-- <span class="qpc-radio"></span>
                                                                    <span class="qpc-title">{{ $selectcolor[$k]->frame }}</span> --}}
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    <?php } }else { ?>
                                                         <div class="quiz-color-box">
                                                                <h4>Data Not Found</h4>
                                                         </div>
                                                    <?php } ?>
                                            </div>
                                           <input type="hidden" id="cid" >
                                            
                                            <div class="steprow">
                                                <div class="step-col">
                                                   <button id="btn3" class="btn btn" style="font-size:<?php if(isset($data[0]->next_fsize)) { echo $data[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($data[0]->next_btnbgcolor)) { echo $data[0]->next_btnbgcolor;} ?>;color:<?php if(isset($data[0]->next_btn_text_color)) { echo $data[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($data[0]->next_bradius)) { echo $data[0]->next_bradius; echo 'px'; }  ?>" onclick="Previous();"><?php if(isset($data[0]->previous_btntext)) { echo $data[0]->previous_btntext; }  ?></button>
                                                   <?php  //if(!empty($selectcolor)){ ?>
                                                   <button id="btn3" class="btn btn" style="font-size:<?php if(isset($data[0]->next_fsize)) { echo $data[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($data[0]->next_btnbgcolor)) { echo $data[0]->next_btnbgcolor;} ?>;color:<?php if(isset($data[0]->next_btn_text_color)) { echo $data[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($data[0]->next_bradius)) { echo $data[0]->next_bradius; echo 'px'; }  ?>" onclick="next();"><?php if(isset($data[0]->showresult_btntext)) { echo $data[0]->showresult_btntext; }  ?></button>
                                                   <?php //} ?>
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
       /* function getSubFrame(cid,frameid,counts,url){
            jQuery('#'+cid).addClass('active-div');
            
            if(counts==0){
                window.top.location =url;
            }else{
                var quizId = $('#quizId').val();
                window.location =jQuery('#next').val()+'/'+cid+'/'+frameid+'/'+quizId;
            }
        }*/
        $( document ).ready(function() {
           
      });
        function Previous(){
            var quizId = $('#quizId').val();
            window.location =jQuery('#previous').val()+'/'+quizId;
        }
        function next(){ 
         window.top.location = jQuery('#nexturl').val();   
           /* var quizId = $('#quizId').val();
            var select_cid = $('#cid').val();
            var allframe = $('#allframe').val();
            if(select_cid == ''){
                alert('Please Select at least 1 Frame');
                return false;
            } 
            window.location =jQuery('#next').val()+'/'+select_cid+'/'+quizId+'/'+allframe;*/
            var quizId = $('#quizId').val();
             var color = $('#cid').val();
            var allFrame = $('#allframe').val();
            var finish = '2';
            var url1 = $('#next').val()+'/'+quizId+'/'+finish;
            $.ajax({
                url: url1,
                type: "POST",
                dataType: "html",
                data: {
                 _token: "{{ csrf_token() }}",
                 allFrame : allFrame,
                 allColor: color
               },
               cache: false,
               success: function(data){ 
                 window.top.location = jQuery('#nexturl').val();
               }
             });
             
        }

          var tmp = [];
            var allColor = [];
           var whereC1 = $('#whereC').val();
           whereP1 = $('#whereP').val();
           whereD1 = $('#whereD').val();
           whereFW1 = $('#whereFW').val();
           whereFN1 = $('#whereFN').val();           
           var where = '';
          $("input[name='checkbox']").change(function() {
             var where = '';
              var shopByColor = ['71190741058','157530652810','71266336834','71269548098','71266402370','71547060290','71266500674','71266205762','71269613634'];
              var shopByPrice = ['71471562818','71471595586','71471628354'];
              var shopByDecor = ['184624742538','184625266826','184626053258','184624316554','184625627274','71551516738','71551418434','71551483970'];
              var shopByFWidth = ['73781510210','73782427714','73782493250'];
              var shopByFName = ['71471857730','71546011714','71546044482','71546077250','71546470466','71546536002','71546601538','71546634306','71546699842','71547387970','71546798146','71546830914','71546896450','71546961986','71546994754','156904947850','71547027522','71547093058','71547125826','71547191362','71547224130','71547256898','71547289666','71547322434','71547355202'];
            var checked = $(this).val();
            var url = 'https://mirrormatellc.myshopify.com/collections/all-frames?';
            
              if ($(this).is(':checked')) { 
                tmp.push(checked);
                allColor.push($(this).attr("data-id"));
              }else{
              tmp.splice($.inArray(checked, tmp),1);
                allColor.splice($.inArray($(this).attr("data-id"),allColor),1);
              }

              $('#cid').val(allColor);
             // $('#cid').val(tmp);
             console.log(tmp);
             for(var i=0;i<tmp.length;i++){
                if(shopByColor.includes(tmp[i])){
                    if(whereC1.includes(tmp[i]) == false){
                       if(whereC1 != ''){
                          whereC1+='%2B'+tmp[i];
                        }else{
                          whereC1+='gf_277393='+tmp[i];
                        } 
                    }
                  }
                  if(shopByPrice.includes(tmp[i])){
                     // whereP+='gf_277394='+checked;
                      if(whereP1 != ''){
                        whereP1+='%2B'+tmp[i];
                      }else{
                        whereP1+='gf_277394='+tmp[i];
                      }
                  }
                  if(shopByDecor.includes(tmp[i])){
                     // whereD+='gf_277395='+checked;
                      if(whereD1 != ''){
                        whereD1+='%2B'+tmp[i];
                      }else{
                        whereD1+='gf_277395='+tmp[i];
                      }
                  }
                  if(shopByFWidth.includes(tmp[i])){
                      //whereFW+='gf_277396='+checked;
                      if(whereFW1 != ''){
                        whereFW1+='%2B'+tmp[i];
                      }else{
                        whereFW1+='gf_277396='+tmp[i];
                      }
                  }
                  if(shopByFName.includes(tmp[i])){
                     // whereFN+='gf_277397='+checked;
                      if(whereFN1 != ''){
                        whereFN1+='%2B'+tmp[i];
                      }else{
                        whereFN1+='gf_277397='+tmp[i];
                      }
                  }
             }
             
            // alert(whereC1);
             if(whereC1 != ''){
                if(where == ''){
                  where+=whereC1;
                }else{
                  where+='&'+whereC1;
                }
             }
              if(whereP1 != ''){
                  if(where == ''){
                    where+=whereP1;
                  }else{
                    where+='&'+whereP1;
                  }
              }
             if(whereD1 != ''){
                if(where == ''){
                  where+=whereD1;
                }else{
                  where+='&'+whereD1;
                }
             }
             if(whereFW1 != ''){
                if(where == ''){
                  where+=whereFW1;
                }else{
                  where+='&'+whereFW1;
                }
             }
             if(whereFN1 != ''){
                if(where == ''){
                  where+=whereFN1;
                }else{
                  where+='&'+whereFN1;
                }
             }
           var finalUrl = url+where;

              $('#nexturl').val(finalUrl);


          });


        $("#close-mod").click(function() {
             window.top.location = 'https://mirrormatellc.myshopify.com/';
        });

        $(document).ready( function(){
          function equalHeight(){
              var heightArray = $(".quiz-pro-color").map( function(){
                       return  $(this).height();
                       }).get();
              var maxHeight = Math.max.apply( Math, heightArray);
              $(".quiz-pro-color").height(maxHeight);
                  }
          equalHeight();
         });
</script>

