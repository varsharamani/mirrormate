<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Recommendation Quiz</title>
    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-back.css') }}">
</head>
<body>
     <?php if(!empty($data)){
        $id =  $data[0]->id ;
      }
      else{
        $id = 0;
      }
      ?>
    <input type="hidden" id="bsicInfoId" value="{{ $id }}">
    <input type="hidden" id="addlink_url" value="{{URL::to('addDataLink')}}">
    <input type="hidden" id="editlink_url" value="{{URL::to('editDataLink')}}">
    <main class="">
        <div class="app-wrapper">
            <div class="main-container">
                <div class="topbar">
                    <div class="t-navbar">
                        <div class="breadcrumbs">
                             <a href="{{URL('/')}}" class="back-link"> Dashboard</a> 
                            <span class="current-title"> / {{ $quizData[0]->quiz_name }}</span>
                        </div>
                        <div class="right-menu">
                            <a href="https://www.mirrormate.com/#mmquiz-<?php echo base64_encode($quizId); ?>" class="btn btn-sm btn-themec btn-preview" target="_blank"> <i class="fas fa-eye"></i> Preview Quiz</a>
                        </div>
                        <div class="topnav-wrap">
                            <ul class="navbar-wrap">
                                <li class="nav-item">
                                    <a class="nav-link <?php if(Request::url() == url('/quiz/'.$quizId)) { echo 'active'; } ?>" href="{{ url('/quiz/'.$quizId) }}" >Back to Home</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link <?php if(Request::url() == url('/matrix/'.$quizId)) { echo 'active'; } ?>" href="{{ url('/matrix/'.$quizId) }}" >Metrics</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <section class="app-apart">
                    <div class="app-position">
                        <div class="app-builder aap-second">
                            <div class="ab-wrap publish-container">
                                <div class="app-row row mt-5">
                                    <div class="col-4">
                                        <div class="builder-logic">
                                            <div class="padd20">
                                                <div class="publish-tab"> 
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="link-tab" data-toggle="tab" href="#link" role="tab" aria-controls="link" aria-selected="true"><span>Installation Code</span></a>
                                                        </li>
                                                      {{--   <li class="nav-item">
                                                            <a class="nav-link" id="buttons-tab" data-toggle="tab" href="#buttons" role="tab" aria-controls="buttons" aria-selected="false" onclick="show('button')"><span>Button</span></a>
                                                        </li> --}}
                                                       <!--  <li class="nav-item">
                                                            <a class="nav-link" id="inline-tab" data-toggle="tab" href="#inline" role="tab" aria-controls="inline" aria-selected="false"><span>Inline</span></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="automatic-tab" data-toggle="tab" href="#automatic" role="tab" aria-controls="automatic" aria-selected="false"><span>Automatic</span></a>
                                                        </li> -->
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="link" role="tabpanel" aria-labelledby="link-tab">

                                                            <div class="pt-content">
                                                                <h6><b>Step 1: </b>Include This Js in Footer</h6> 
                                                                <p><b>https://script.mirrormate.com/mirrormate_quiz/public/js/quiz-frame.js</b></p>
                                                                <h6><b>Step 2: </b>Where You Want Link Copy Below Code as a href</h6>
                                                                 <p><b>https://www.mirrormate.com/#mmquiz-<?php echo base64_encode($quizId); ?></b></p>
                                                            </div>
                                                        </div>

                                                               <!-- <div class="input-w-select">
                                                                    <div class="iws-title">Popup width</div>
                                                                    <div class="iws-input">
                                                                        <input type="number" class="form-control" placeholder="" autocomplete="off" value = "<?php if(isset($data[0]->link_popup_width)) { echo $data[0]->link_popup_width; }  ?>" id="pwidth" name="pwidth">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Popup Height</div>
                                                                    <div class="iws-input">
                                                                        <input type="number" autocomplete="off" class="form-control"  placeholder=""  value = "<?php if(isset($data[0]->link_popup_height)) { echo $data[0]->link_popup_height; }  ?>" id="pheight" name="pheight">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <button class="btn btn-bgcolor">Get The Code</button> -->
                                                           
                                                       <!--  <div class="tab-pane fade" id="buttons" role="tabpanel" aria-labelledby="buttons-tab">
                                                            <div class="pt-content">
                                                                <p>Display a popup quiz when your customers click on the button</p>
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Popup width</div>
                                                                    <div class="iws-input">
                                                                        <input class="form-control" type="number" autocomplete="off" placeholder=""  value = "<?php if(isset($data[0]->btn_popup_width)) { echo $data[0]->btn_popup_width; }  ?>" id="btnpwidth" name="pwidth">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Popup Height</div>
                                                                    <div class="iws-input">
                                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value = "<?php if(isset($data[0]->btn_popup_height)) { echo $data[0]->btn_popup_height; }  ?>" id="btnpheight" name="pheight">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Button text</div>
                                                                    <div class="iws-input">
                                                                        <input  type="text" class="form-control" placeholder="Write text here" value = "<?php if(isset($data[0]->btn_text)) { echo $data[0]->btn_text; }  ?>" id="btntext" name="btntext">
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Button Background Color</div>
                                                                    <div class="iws-input">
                                                                        <input  class="form-control" type="color" id="btncolor" value="<?php if(isset($data[0]->btn_color)) { echo $data[0]->btn_color; }  ?>" name="btncolor"/>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                 <div class="input-w-select">
                                                                    <div class="iws-title">Button Text Color</div>
                                                                    <div class="iws-input">    
                                                                     <input class="form-control" type="color" id="btn_text_color" value="<?php if(isset($data[0]->btn_text_color)) { echo $data[0]->btn_text_color; }  ?>" name="btntextcolor"/>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Font Size</div>
                                                                    <div class="iws-input">
                                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value = "<?php if(isset($data[0]->btn_font_size)) { echo $data[0]->btn_font_size; }  ?>" id="fsize" name="fsize">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Border radius</div>
                                                                    <div class="iws-input">

                                                                        <input class="form-control" type="number" autocomplete="off" value = "<?php if(isset($data[0]->btn_border_radius)) { echo $data[0]->btn_border_radius; }  ?>" id="bradius" name="bradius">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <button class="btn btn-bgcolor">Get The Code</button>
                                                            </div>
                                                        </div> -->
                                                       <!--  <div class="tab-pane fade" id="inline" role="tabpanel" aria-labelledby="inline-tab">
                                                            <div class="pt-content">
                                                                <p>Insert the quiz embedded in the content of your website </p>
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Width</div>
                                                                    <div class="iws-input">
                                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value="108">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Height</div>
                                                                    <div class="iws-input">
                                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value="600">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <button class="btn btn-bgcolor">Get The Code</button>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="automatic" role="tabpanel" aria-labelledby="automatic-tab">
                                                            <div class="pt-content">
                                                                <p>Display an automatic popup quiz when your customers remain on the page for certain amount of time</p>
                                                                <p>Automatic popups are very intrusive so they're shown only once to each customer to ensure they don't have a negative user experience. </p>
                                                                <div class="alert alert-primary" role="alert">
                                                                    In order to test it on your store, open a new private browser window. 
                                                                </div>
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Popup width</div>
                                                                    <div class="iws-input">
                                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value="108">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Popup Height</div>
                                                                    <div class="iws-input">
                                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value="100">
                                                                        <div class="iws-endperson">%</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <div class="input-w-select">
                                                                    <div class="iws-title">Wait Seconds</div>
                                                                    <div class="iws-input">
                                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value="20">
                                                                        <div class="iws-endperson">sec.</div>
                                                                    </div>
                                                                </div>
                                                                <hr class="dot">
                                                                <button class="btn btn-bgcolor">Get The Code</button>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-8">
                                        <div class="padd20">
                                            <div class="air-preview box-shadow bg-white" id="link1">
                                                <div class="air-header">
                                                    <div class="air-circle air-close"></div>
                                                    <div class="air-circle air-minmize"></div>
                                                    <div class="air-circle air-maximize"></div>
                                                </div>
                                                <div class="air-content">
                                                    <div class="air-bar-top"></div>
                                                    <div class="air-bar"></div>
                                                    <div class="air-bar"></div>
                                                    <div class="air-bar"></div>
                                                    <div class="air-bar"></div>
                                                    <div class="air-bar w-75"></div>
                                                    <br>
                                                    <br>
                                                    <div class="text-center">
                                                        <button class="popup-link" style="color: rgb(68, 153, 255); font-size: 18px;">TAKE OUR QUIZ</button>
                                                        <div class="popup-helper font-sm">Click to preview popup</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="air-preview box-shadow bg-white" id="button" style="display: none;">
                                                <div class="air-header">
                                                    <div class="air-circle air-close"></div>
                                                    <div class="air-circle air-minmize"></div>
                                                    <div class="air-circle air-maximize"></div>
                                                </div>
                                                <div class="air-content">
                                                    <div class="air-bar-top"></div>
                                                    <div class="air-bar"></div>
                                                    <div class="air-bar"></div>
                                                    <div class="air-bar"></div>
                                                    <div class="air-bar"></div>
                                                    <div class="air-bar w-75"></div>
                                                    <br>
                                                    <br>
                                                    <div class="text-center">
                                                        <input type="button" id="btn" value="<?php if(isset($data[0]->btn_text)) { echo $data[0]->btn_text; }  ?>" style="font-size:<?php if(isset($data[0]->btn_font_size)) { echo $data[0]->btn_font_size;; echo 'px'; }  ?>;background-color:<?php if(isset($data[0]->btn_color)) { echo $data[0]->btn_color;} ?>;color:<?php if(isset($data[0]->btn_text_color)) { echo $data[0]->btn_text_color;} ?>;border-radius:<?php if(isset($data[0]->btn_border_radius)) { echo $data[0]->btn_border_radius;; echo 'px'; }  ?>">
                                                        <div class="popup-helper font-sm">Click to preview popup</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
        <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- <script src="fontawesome/js/all.min.js"></script> -->
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> 


</body>
</html>
<script>
    function show(type){
        if(type == 'link'){
            $('#button').css('display','none');
            $('#link1').css('display','block');
        } 
        if(type == 'button'){
             $('#link1').css('display','none');
            $('#button').css('display','block');
        }  
    }
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  $("#pheight").change(function(){

    var link_popup_width = $('#pwidth').val();
    var link_popup_height = $('#pheight').val();
    var id = $('#bsicInfoId').val();
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:1,
       link_popup_width: link_popup_width,
       link_popup_height: link_popup_height
     },
     cache: false,
     success: function(data){  
     }
   });
  });

  $("#pwidth").change(function(){

    var link_popup_width = $('#pwidth').val();
    var link_popup_height = $('#pheight').val();
    var id = $('#bsicInfoId').val();
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }
    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:1,
       link_popup_width: link_popup_width,
       link_popup_height: link_popup_height
     },
     cache: false,
     success: function(data){    
     }
   });
  });

  $("#btnpheight").change(function(){

    var btnpwidth = $('#btnpwidth').val();
    var btnpheight = $('#btnpheight').val();
    var btntext = $('#btntext').val();
    var btncolor = $('#btncolor').val();
    var fsize = $('#fsize').val();
    var bradius = $('#bradius').val();
    var id = $('#bsicInfoId').val();
    var btn_text_color = $('#btn_text_color').val();
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:2,
       btn_popup_width: btnpwidth,
       btn_popup_height: btnpheight,
       btntext: btntext,
       btncolor: btncolor,
       fsize: fsize,
       bradius: bradius,
       btn_text_color:btn_text_color
     },
     cache: false,
     success: function(data){    
     }
   });
  });

  $("#btnpwidth").change(function(){
    var btnpwidth = $('#btnpwidth').val();
    var btnpheight = $('#btnpheight').val();
    var btntext = $('#btntext').val();
    var btncolor = $('#btncolor').val();
    var fsize = $('#fsize').val();
    var bradius = $('#bradius').val();
    var btn_text_color = $('#btn_text_color').val();
    var id = $('#bsicInfoId').val();
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:2,
       btn_popup_width: btnpwidth,
       btn_popup_height: btnpheight,
       btntext: btntext,
       btncolor: btncolor,
       fsize: fsize,
       bradius: bradius,
       btn_text_color:btn_text_color
     },
     cache: false,
     success: function(data){    
     }
   });
  });


  $("#btntext").keyup(function(){
    var btnpwidth = $('#btnpwidth').val();
    var btnpheight = $('#btnpheight').val();
    var btntext = $('#btntext').val();
    var btncolor = $('#btncolor').val();
    var fsize = $('#fsize').val();
    var bradius = $('#bradius').val();
    var btn_text_color = $('#btn_text_color').val();
    var id = $('#bsicInfoId').val();
    $('#btn').val($(this).val());
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:2,
       btn_popup_width: btnpwidth,
       btn_popup_height: btnpheight,
       btntext: btntext,
       btncolor: btncolor,
       fsize: fsize,
       bradius: bradius,
       btn_text_color:btn_text_color
     },
     cache: false,
     success: function(data){    
     }
   });
  });


  $("#btncolor").change(function(){
    var btnpwidth = $('#btnpwidth').val();
    var btnpheight = $('#btnpheight').val();
    var btntext = $('#btntext').val();
    var btncolor = $('#btncolor').val();
    var fsize = $('#fsize').val();
    var bradius = $('#bradius').val();
    var btn_text_color = $('#btn_text_color').val();
    var id = $('#bsicInfoId').val();
    $("#btn").css('background-color',$(this).val());
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:2,
       btn_popup_width: btnpwidth,
       btn_popup_height: btnpheight,
       btntext: btntext,
       btncolor: btncolor,
       fsize: fsize,
       bradius: bradius,
       btn_text_color:btn_text_color
     },
     cache: false,
     success: function(data){    
     }
   });
  });

  $("#btn_text_color").change(function(){
    var btnpwidth = $('#btnpwidth').val();
    var btnpheight = $('#btnpheight').val();
    var btntext = $('#btntext').val();
    var btncolor = $('#btncolor').val();
    var fsize = $('#fsize').val();
    var bradius = $('#bradius').val();
    var btn_text_color = $('#btn_text_color').val();
    var id = $('#bsicInfoId').val();
    $("#btn").css('color',$(this).val());
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:2,
       btn_popup_width: btnpwidth,
       btn_popup_height: btnpheight,
       btntext: btntext,
       btncolor: btncolor,
       fsize: fsize,
       bradius: bradius,
       btn_text_color:btn_text_color
     },
     cache: false,
     success: function(data){    
     }
   });
  });

  $("#fsize").change(function(){
    var btnpwidth = $('#btnpwidth').val();
    var btnpheight = $('#btnpheight').val();
    var btntext = $('#btntext').val();
    var btncolor = $('#btncolor').val();
    var fsize = $('#fsize').val();
    var bradius = $('#bradius').val();
    var id = $('#bsicInfoId').val();
    var btn_text_color = $('#btn_text_color').val();
    $("#btn").css('font-size',$(this).val() + 'px');
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:2,
       btn_popup_width: btnpwidth,
       btn_popup_height: btnpheight,
       btntext: btntext,
       btncolor: btncolor,
       fsize: fsize,
       bradius: bradius,
       btn_text_color:btn_text_color
     },
     cache: false,
     success: function(data){ 

     }
   });
  });

  $("#bradius").change(function(){
    var btnpwidth = $('#btnpwidth').val();
    var btnpheight = $('#btnpheight').val();
    var btntext = $('#btntext').val();
    var btncolor = $('#btncolor').val();
    var fsize = $('#fsize').val();
    var bradius = $('#bradius').val();
    var btn_text_color = $('#btn_text_color').val();
    var id = $('#bsicInfoId').val();

    $("#btn").css('border-radius',$(this).val()+'px');
    if(id == 0){
      var add_url =  $('#addlink_url').val();
      var  url = add_url;

    }else{
      var edit_url =  $('#editlink_url').val();
      var  url = edit_url+'/'+id;
    }

    $.ajax({
      url: url,
      type: "POST",
      dataType: "JSON",
      data: {
       _token: "{{ csrf_token() }}",
       data:2,
       btn_popup_width: btnpwidth,
       btn_popup_height: btnpheight,
       btntext: btntext,
       btncolor: btncolor,
       fsize: fsize,
       bradius: bradius,
       btn_text_color:btn_text_color
     },
     cache: false,
     success: function(data){    
     }
   });
  });
</script>