<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}?v=1">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css')}}?v=2">
        <link rel="stylesheet" href="{{ asset('css/app-back.css') }}?v=3">
    </head>     
    <style type="text/css">
  
      .step-col {
        display: flex;
        justify-content: space-between;
    }
    
      .arrow {
      border: solid black;
      border-width: 0 3px 3px 0;
      display: inline-block;
      padding: 3px;
    }

    .up {
      transform: rotate(-135deg);
      -webkit-transform: rotate(-135deg);
    }
    .modal {
    display:    none;
    position:   fixed;
        z-index:    1000;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 ) 
                    url('http://i.stack.imgur.com/FhHRx.gif') 
                    50% 50% 
                    no-repeat;
    }

    /* When the body has the loading class, we turn
       the scrollbar off with overflow:hidden */
    body.loading .modal {
        overflow: hidden;   
    }

    /* Anytime the body has the loading class, our
       modal element will be visible */
    body.loading .modal {
        display: block;
    }

  .alert-msg-success{
    flex: 0 0 100%;
    -ms-flex: 0 0 100%;
    max-width: 100%;
    color: green;
  }

  .alert-msg-danger{
    flex: 0 0 100%;
    -ms-flex: 0 0 100%;
    max-width: 100%;
    color: red;
  }
    </style>

    <main class="">

      <input type="hidden" id="addlink_url" value="{{URL::to('addDataLink')}}">
      <input type="hidden" id="editlink_url" value="{{URL::to('editDataLink')}}">
      <input type="hidden" id="addbasic" value="{{URL::to('addbasic')}}">
      <input type="hidden" id="editbasic" value="{{URL::to('editbasic')}}">
      <input type="hidden" id="appendFrame" value="{{URL::to('appendFrame')}}">
      <input type="hidden" id="add_url" value="{{URL::to('addData')}}">
      <input type="hidden" id="update_url" value="{{URL::to('editData')}}">
      <input type="hidden" id="delete_url" value="{{URL::to('deleteData')}}">
      <input type="hidden" id="home_url" value="{{URL('/quiz/'.$quizId)}}">
      <input type="hidden" id="addcolor_url" value="{{URL::to('addcolor')}}">
      <input type="hidden" id="editcolor_url" value="{{URL::to('editColData')}}">
      <input type="hidden" id="deletecolor_url" value="{{URL::to('deleteColData')}}">
      <input type="hidden" id="sel_col" value="{{URL::to('selectedCol')}}">
      <input type="hidden" id="check_frame" value="{{ url('/check_frame') }}">
      <input type="hidden" id="check_Color" value="{{ url('/check_Color') }}">
      <input type="hidden" id="change_info" value="{{ URL::to('/change_info') }}">
      <input type="hidden" id="quiz1" value="{{ url('/mmquiz/next') }}">
      <input type="hidden" id="sortingFrame" value="{{URL::to('sortingFrame')}}">
      <input type="hidden" id="sortingColor" value="{{URL::to('sortingColor')}}">
      <input type="hidden" id="framePrev" value="{{URL::to('framePrev')}}">
      <input type="hidden" id="frame_col_add" value="{{URL::to('frame_col_add')}}">
       <input type="hidden" id="frame_col_edit" value="{{URL::to('frame_col_edit')}}">
      <input type="hidden" id="deleteFcolor_url" value="{{URL::to('deleteFColData')}}">
      <input type="hidden" id="sortingFrameColor" value="{{URL::to('sortingFrameColor')}}">
      <input type="hidden" id="sel_frame_col" value="{{URL::to('selectedFrameCol')}}">
       <input type="hidden" id="change_info_col" value="{{ URL::to('change_info_col') }}">
       <input type="hidden" id="check_FColor" value="{{URL::to('check_FColor')}}">
        <input type="hidden" id="lastInsertId">
     
      <?php if(!empty($basic_infos)){
            $id =  $basic_infos[0]->id;
        }
        else{
            $id = 0;
        }  
        //$quizId = Session::get('quizId');  

      ?>
      <input type="hidden" id="quiz_id" value="{{ $quizId }}">
         <input type="hidden" id="bsicInfoId" value="{{ $id }}">
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
                                      <a class="nav-link <?php if(Request::url() == url('/publish/'.$quizId)) { echo 'active'; } ?>" href="{{ url('/publish/'.$quizId) }}" >Publish</a>
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
                          <div class="app-builder">
                              <div class="ab-wrap">
                                  <div class="builder-container app-row row no-gutters">
                                      <div class="col-6 quiz-bilder" id="right-side-1">
                                          <!-- <div class="qb-header">
                                              <h5> <b>Quiz Builder</b> - <a class="qbh-link" href="javascript:void(0);">Learn how the quiz buider works</a></h5>
                                          </div> -->
                                          <div class="padd20" >
                                             <div onclick="show('s1');"> <div class="steps">  <!--stepbox--> <!-- "step-active" class for active -->
                                         
                                                  <div class="steps-box step-shadow">
                                                      <div class="step--title">
                                                        <h3>Main Step</h3>
                                                      </div>
                                                      <div class="step-no">
                                                          <div class="step-type">
                                                              <i class="fas fa-comment-dots"></i> <!-- <span>1</span> -->
                                                          </div>
                                                      </div>
                                                      <div class="step-content">
                                                          <div class="steprow">
                                                              <div class="step-title">
                                                                  <textarea class="form-control sr-area" name="" id="title_1" rows="1" ><?php echo $basic_infos[0]->title_1; ?></textarea>
                                                              </div>
                                                              <div class="step-description">
                                                                  <textarea class="form-control sr-area" name="" id="title_2" rows="1"><?php echo $basic_infos[0]->title_2; ?></textarea>
                                                              </div>
                                                          </div>
                                                          <div class="steprow text-center">
                                                                <button id="btn1" class="btn btn" style="font-size:<?php if(isset($basic_infos[0]->btn_font_size)) { echo $basic_infos[0]->btn_font_size; echo 'px'; }  ?>;background-color:<?php if(isset($basic_infos[0]->btn_bgcolor)) { echo $basic_infos[0]->btn_bgcolor;} ?>;color:<?php if(isset($basic_infos[0]->btn_txtcolor)) { echo $basic_infos[0]->btn_txtcolor;} ?>;border-radius:<?php if(isset($basic_infos[0]->btn_border_radius)) { echo $basic_infos[0]->btn_border_radius;; echo 'px'; }  ?>"><?php if(isset($basic_infos[0]->btn_text)) { echo $basic_infos[0]->btn_text; }  ?></button>
                                                          </div>  
                                                          <div align="right">
                                                            <button class="btn btn-settings" type="button" name="" onclick="changeSettings('1');"><i class="fas fa-cogs"></i></button>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                            <div onclick="show('s2');">
                                              <div class="steps">  <!--stepbox--> 
                                                  <div class="steps-box step-shadow">
                                                    <div id="framemsg">
                                                    </div>
                                                    <div class="step--title">
                                                        <h3>Primary Step</h3>
                                                      </div>
                                                      <div class="step-no">
                                                          <div class="step-type">
                                                              <i class="far fa-image"></i> <!-- <span>2</span> -->
                                                          </div>
                                                      </div>
                                                      <div class="step-content">
                                                          <div class="steprow">
                                                              <div class="step-title">
                                                                  <textarea class="form-control sr-area" name="" id="subtitle_1" rows="1" ><?php echo $basic_infos[0]->subtitle_1; ?></textarea>
                                                              </div>
                                                              <div class="step-description">
                                                                  <textarea class="form-control sr-area" name="" id="subtitle_2" rows="1"><?php echo $basic_infos[0]->subtitle_2; ?></textarea>
                                                              </div>
                                                              <div class="step-choice w-100 mb-30">
                                                                  <div id="" class="new-choice"> <!-- Repeat columns -->
                                                                      <div class="sc-row">
                                                                          <hr>
                                                                          <?php if(!empty($frames)) {  for($j=0;$j<count($frames);$j++) { ?>
                                                                          <div id="main<?php echo $frames[$j]->id; ?>">
                                                                              <div class="sc-choice frameSort" id="<?php echo $frames[$j]->id; ?>">
                                                                                <a class="stepsorting" data-scroll="" href="javascript:void(0);">
                                                                                  <span class="fup" onclick="sortUpFrame('<?php echo $frames[$j]->id; ?>');">
                                                                                    <i class="fas fa-angle-up"></i>
                                                                                  </span>
                                                                                  <span class="fdown" onclick="sortDownFrame('<?php echo $frames[$j]->id; ?>');">
                                                                                    <i class="fas fa-angle-down"></i>
                                                                                  </span>
                                                                                </a>
                                                                                  <span class="stepimg">
                                                                                      <div class="imgpreview" id="imgpreview<?php echo $j; ?>" style="background-image: url(<?php echo $frames[$j]->frame_img ?>);"></div>
                                                                                  </span>
                                                                                  <span class="stepbullet">- </span>
                                                                                  <div class="dropdown step-drop">
                                                                                      <button class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                            <span id="btntext<?php echo $j; ?>"><?php echo $frames[$j]->frame ?> </span>
                                                                                      </button>
                                                                                      <div class="dropdown-menu drop-name<?php echo $frames[$j]->id; ?>frame" aria-labelledby="dropdownMenuButton">
                                                                                         <div class="search-frame">
                                                                                          <div class="dd-search"><input id="txtSearchValue_<?php echo $frames[$j]->id; ?>frame" autocomplete="off" onkeyup="filter('<?php echo $frames[$j]->id; ?>','','frame');"  class="dd-searchbox" type="text" placeholder="Search.."></div>
                                                                                        </div>
                                                                                        <?php
                                                                                          $allFID = array();
                                                                                          $selFrames = DB::select('select * from mirrormates where quiz_id = '.$quizId);
                                                                                          for($p=0;$p<count($selFrames);$p++){
                                                                                              array_push($allFID, $selFrames[$p]->frame_id);
                                                                                          }
                                                                                        for($i=0;$i<count($data['response']);$i++) { 
                                                                                          if(!in_array($data['response'][$i]['id'], $allFID)){
                                                                                         $img = '';
                                                                                         $title_str = '';
                                                                                           $title_str = str_replace('"',"quote",$data['response'][$i]['title']);
                                                                                            if(isset($data['response'][$i]['image']['src'])){
                                                                                               $img =$data['response'][$i]['image']['src']; 
                                                                                            }
                                                                                          ?>
                                                                                           <a class="dropdown-item" href="javascript:void(0);" onclick="selFrame('<?php echo $title_str; ?>','<?php echo $data['response'][$i]['id']; ?>','<?php echo $img; ?>','<?php echo $data['response'][$i]['handle']; ?>','<?php echo $j; ?>','<?php echo $frames[$j]->id; ?>');"><?php echo $data['response'][$i]['title']; ?></a>
                                                                                          <?php } } ?>
                                                                                      </div>
                                                                                    </div>
                                                                                  <span id="add" class="choicestep" onclick="addFrame('addFrame');">
                                                                                      <i class="fas fa-plus"></i>
                                                                                  </span>
                                                                                  <span id="remove" class="choicestep" onclick="removeFrame('<?php echo $frames[$j]->id; ?>');">
                                                                                      <i class="fas fa-minus"></i>
                                                                                  </span>
                                                                              </div>
                                                                               <br/ id="brF<?php echo $frames[$j]->id; ?>">
                                                                               <input type="hidden" id="fid<?php echo $j; ?>" value="<?php echo  $frames[$j]->id; ?>">
                                                                          </div>
                                                                          <?php } } 
                                                                          else { $rand = 'abc12'; ?>
                                                                           <div id="main<?php echo $rand; ?>">
                                                                          <div class="sc-choice frameSort" id="abc12">
                                                                            <a class="stepsorting" data-scroll="" href="javascript:void(0);">
                                                                                  <span class="fup<?php echo $rand; ?>" onclick="sortUpFrame();">
                                                                                    <i class="fas fa-angle-up"></i>
                                                                                  </span>
                                                                                  <span class="fdown<?php echo $rand; ?>" onclick="sortDownFrame();">
                                                                                    <i class="fas fa-angle-down"></i>
                                                                                  </span>
                                                                                </a>
                                                                              <span class="stepimg">
                                                                                  <div class="imgpreview" id="imgpreview<?php echo $rand; ?>" style="background-image: url({{ asset('stepimg.jpg') }});"></div>
                                                                              </span>
                                                                              <span class="stepbullet">- </span>
                                                                              <div class="dropdown step-drop">
                                                                                  <button class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <span id="btntext<?php echo $rand; ?>">Select</span>
                                                                                  </button>
                                                                                 <div class="dropdown-menu drop-name<?php echo $rand; ?>frame"aria-labelledby="dropdownMenuButton">
                                                                                    <div class="search-frame">
                                                                                        <div class="dd-search"><input id="txtSearchValue_<?php echo $rand; ?>frame" autocomplete="off" onkeyup="filter('<?php echo $rand; ?>','','frame');"  class="dd-searchbox" type="text" placeholder="Search.."></div>
                                                                                    </div>
                                                                                    <?php 
                                                                                    for($i=0;$i<count($data['response']);$i++) { 
                                                                                     $img = '';
                                                                                     $title_str = '';
                                                                                       $title_str = str_replace('"',"quote",$data['response'][$i]['title']);
                                                                                    if(isset($data['response'][$i]['image']['src'])){

                                                                                           $img =$data['response'][$i]['image']['src']; }
                                                                                      ?>
                                                                                      <a class="dropdown-item" href="javascript:void(0);" onclick="selFrame('<?php echo $title_str; ?>','<?php echo $data['response'][$i]['id']; ?>','<?php echo $img; ?>','<?php echo $data['response'][$i]['handle']; ?>','<?php echo $rand; ?>');"><?php echo $data['response'][$i]['title']; ?></a>
                                                                                      <?php } ?>
                                                                                  </div>
                                                                                </div>
                                                                              <span id="add" class="choicestep" onclick="addFrame('addFrame');">
                                                                                  <i class="fas fa-plus"></i>
                                                                              </span>
                                                                              <span id="remove" class="choicestep <?php echo $rand; ?>" onclick="removeFrame('abc12');">
                                                                                  <i class="fas fa-minus"></i>
                                                                              </span>
                                                                          </div>
                                                                          <br/ id="brFabc12">
                                                                           <input type="hidden" id="fid<?php echo $rand; ?>" value="">
                                                                        </div>
                                                                          <?php } ?>
                                                                          <div id="addFrame"></div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                           <div class="steprow text-center">
                                                                <button id="btn2" class="btn btn" style="font-size:<?php if(isset($basic_infos[0]->next_fsize)) { echo $basic_infos[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($basic_infos[0]->next_btnbgcolor)) { echo $basic_infos[0]->next_btnbgcolor;} ?>;color:<?php if(isset($basic_infos[0]->next_btn_text_color)) { echo $basic_infos[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($basic_infos[0]->next_bradius)) { echo $basic_infos[0]->next_bradius; echo 'px'; }  ?>"><?php if(isset($basic_infos[0]->previous_btntext)) { echo $basic_infos[0]->previous_btntext.' / '; }  ?><?php if(isset($basic_infos[0]->next_btntext)) { echo $basic_infos[0]->next_btntext; }  ?></button>
                                                          </div>
                                                          <div align="right">
                                                            <button class="btn btn-settings" type="button" name="" onclick="changeSettings('3');"><i class="fas fa-cogs"></i></button>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                              <?php    if(!empty($frames)) {   $srno = 3; for($p=0;$p<count($frames);$p++) {  ?>
                                                 <div id="frame_col<?php echo $frames[$p]->id; ?>" onclick="show('s3','<?php echo $frames[$p]->id; ?>');"> 
                                                  <div class="steps" id="frameRemove<?php echo $frames[$p]->id; ?>">  <!--stepbox--> 
                                                  <div class="steps-box step-shadow">
                                                     <div id="colormsg<?php echo $frames[$p]->id; ?>" class="colormsg">
                                                    </div>
                                                    <div class="step--title">
                                                        <h3>Secondary Step For <span id="stitile<?php echo $frames[$p]->id; ?>"><?php echo $frames[$p]->frame; ?></span></h3>
                                                      </div>
                                                      <div style="margin-top: 52px;"></div>
                                                      <div class="step-no">
                                                          <div class="step-type">
                                                              <i class="far fa-image"></i><!--  <span><?php echo $srno; ?></span> -->
                                                          </div>
                                                      </div>
                                                      <div class="step-content">
                                                          <div class="steprow">
                                                            <div id="sec_<?php echo $frames[$p]->id; ?>" class="sec">
                                                                <?php if($p == 0){ ?>
                                                                   <div class="step-title">
                                                                        <div onclick="show('s3','<?php echo $frames[$p]->id; ?>');"><textarea class="form-control sr-area" name="" id="choose" rows="1" placeholder="You chose Title" onkeyup="change_info('<?php echo $basic_infos[0]->id; ?>');"><?php echo  $basic_infos[0]->sec_title_1; ?></textarea></div>
                                                                  </div>
                                                                  <div class="step-description">
                                                                      <div onclick="show('s3','<?php echo $frames[$p]->id; ?>');"><textarea class="form-control sr-area" name="" id="choose_desc" placeholder="You chose Description" rows="1" onkeyup="change_info('<?php echo $basic_infos[0]->id; ?>');"><?php echo $basic_infos[0]->sec_title_2; ?></textarea></div>
                                                                  </div>
                                                                  <hr>
                                                                  <?php } ?>
                                                            </div>

                                                              <div class="step-choice w-100 mb-30">
                                                                  <div id="" class="new-choice"> <!-- Repeat columns -->
                                                                      <div class="sc-row">
                                                                          <?php  $ranom = rand();
                                                                          $allCID = array();
                                                                              $colors = DB::select('select * from colors where select_frame_id='.$frames[$p]->id.' order by sort');
                                                                           if(!empty($colors)) {  
                                                                            for($k=0;$k<count($colors);$k++){
                                                                              array_push($allCID,$colors[$k]->frame_id);
                                                                            }

                                                                            for($j=0;$j<count($colors);$j++) { 
                                                                            ?>
                                                                          <div id="main_col<?php echo $colors[$j]->id; ?><?php echo $frames[$p]->id; ?>">
                                                                              <div class="sc-choice colorSort<?php echo $frames[$p]->id; ?>" id="Col<?php echo $colors[$j]->id; echo '_'; ?><?php echo $frames[$p]->id; ?>">
                                                                                <a class="stepsorting" data-scroll="" href="javascript:void(0);">
                                                                                  <span class="fup" onclick="sortUpColor('<?php echo $colors[$j]->id; ?>','<?php echo $frames[$p]->id; ?>');">
                                                                                    <i class="fas fa-angle-up"></i>
                                                                                  </span>
                                                                                  <span class="fdown" onclick="sortDownColor('<?php echo $colors[$j]->id; ?>','<?php echo $frames[$p]->id; ?>');">
                                                                                    <i class="fas fa-angle-down"></i>
                                                                                  </span>
                                                                                </a>
                                                                                  <span class="stepimg">
                                                                                      <div class="imgpreview" id="imgpreviewCol<?php echo $j; ?><?php echo $frames[$p]->id; ?>" style="background-image: url(<?php echo $colors[$j]->frame_img ?>);"></div>
                                                                                  </span>
                                                                                  <span class="stepbullet">- </span>
                                                                                  <!-- <input class="form-control" placeholder="" value="Traditional"> -->
                                                                                  <div class="dropdown step-drop">
                                                                                      <button  onclick="show('s3','<?php echo $frames[$p]->id; ?>');" class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                            <span id="btntextCol<?php echo $j; ?><?php echo $frames[$p]->id; ?>"><?php echo $colors[$j]->frame ?> </span>
                                                                                      </button>
                                                                                     <div class="dropdown-menu drop-name<?php echo $colors[$j]->id; ?><?php echo $frames[$p]->id; ?>color" aria-labelledby="dropdownMenuButton">
                                                                                          <div class="search-frame">
                                                                                            <div class="dd-search"><input id="txtSearchValue_<?php echo $colors[$j]->id; ?><?php echo $frames[$p]->id; ?>color" autocomplete="off" onkeyup="filter('<?php echo $colors[$j]->id; ?>','<?php echo $frames[$p]->id; ?>','color');"  class="dd-searchbox" type="text" placeholder="Search.."></div>
                                                                                          </div>
                                                                                        <?php 
                                                                                         for($i=0;$i<count($data['response']);$i++) {
                                                                                          if($frames[$p]->frame_id != $data['response'][$i]['id']){ if(!in_array($data['response'][$i]['id'], $allCID)) {
                                                                                         $img = '';
                                                                                         $title_str = '';
                                                                                           $title_str = str_replace('"',"quote",$data['response'][$i]['title']);
                                                                                            if(isset($data['response'][$i]['image']['src'])){
                                                                                               $img =$data['response'][$i]['image']['src']; 
                                                                                            }
                                                                                          ?>
                                                                                          <a class="dropdown-item" href="javascript:void(0);" onclick="selColor('<?php echo $title_str; ?>','<?php echo $data['response'][$i]['id']; ?>','<?php echo $img; ?>','<?php echo $data['response'][$i]['handle']; ?>','<?php echo $j; ?>','<?php echo $colors[$j]->id; ?>','<?php echo $frames[$p]->id; ?>');"><?php echo $data['response'][$i]['title']; ?></a>
                                                                                          <?php } } } ?>
                                                                                      </div>
                                                                                    </div>
                                                                                  <span id="add" class="choicestep" onclick="addFrame('addCol','<?php echo $frames[$p]->id; ?>');">
                                                                                      <i class="fas fa-plus"></i>
                                                                                  </span>
                                                                                  <span id="remove" class="choicestep" onclick="removeFrame('<?php echo $colors[$j]->id; ?>','deleteCol','<?php echo $frames[$p]->id; ?>');">
                                                                                      <i class="fas fa-minus"></i>
                                                                                  </span>
                                                                              </div>
                                                                              <br/ id="brC<?php echo $colors[$j]->id; ?><?php echo $frames[$p]->id; ?>">
                                                                              <input type="hidden" id="cid<?php echo $j; ?><?php echo $frames[$p]->id; ?>" value="<?php echo $colors[$j]->id; ?>">
                                                                          </div>
                                                                          <?php $ranom++; } } 
                                                                          else { $rand = 'abc12'; ?>
                                                                           <div id="main_col<?php echo $rand; ?><?php echo $frames[$p]->id; ?>">
                                                                            <div class="sc-choice" id="Col<?php echo $rand; ?><?php echo $frames[$p]->id; ?>">
                                                                               <a class="stepsorting" data-scroll="" href="javascript:void(0);">
                                                                                    <span class="fup<?php echo $rand ?><?php echo $frames[$p]->id; ?>" onclick="sortUpColor();">
                                                                                      <i class="fas fa-angle-up"></i>
                                                                                    </span>
                                                                                    <span class="fdown<?php echo $rand ?><?php echo $frames[$p]->id; ?>" onclick="sortDownColor();">
                                                                                      <i class="fas fa-angle-down"></i>
                                                                                    </span>
                                                                                  </a>
                                                                                <span class="stepimg">
                                                                                    <div class="imgpreview" id="imgpreviewCol<?php echo $rand; ?><?php echo $frames[$p]->id; ?>" style="background-image: url({{ asset('stepimg.jpg')}} );"></div>
                                                                                </span>
                                                                                <span class="stepbullet">- </span>
                                                                                <!-- <input class="form-control" placeholder="" value="Traditional"> -->
                                                                                <div class="dropdown step-drop">
                                                                                    <button  onclick="show('s3','<?php echo $frames[$p]->id; ?>');" class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                          <span id="btntextCol<?php echo $rand; ?><?php echo $frames[$p]->id; ?>">Select</span>
                                                                                    </button>
                                                                                     <div class="dropdown-menu drop-name<?php echo $rand; ?><?php echo $frames[$p]->id; ?>color" aria-labelledby="dropdownMenuButton">
                                                                                       <div class="search-frame">
                                                                                        <div class="dd-search"><input id="txtSearchValue_<?php echo $rand; ?><?php echo $frames[$p]->id; ?>color" autocomplete="off" onkeyup="filter('<?php echo $rand; ?>','<?php echo $frames[$p]->id; ?>','color');"  class="dd-searchbox" type="text" placeholder="Search.."></div>
                                                                                    </div>
                                                                                      <?php 
                                                                                      for($i=0;$i<count($data['response']);$i++) { 
                                                                                        if($frames[$p]->frame_id != $data['response'][$i]['id']){ 
                                                                                       $img = '';
                                                                                       $title_str = '';
                                                                                         $title_str = str_replace('"',"quote",$data['response'][$i]['title']);
                                                                                      if(isset($data['response'][$i]['image']['src'])){

                                                                                             $img =$data['response'][$i]['image']['src']; }
                                                                                        ?>
                                                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="selColor('<?php echo $title_str; ?>','<?php echo $data['response'][$i]['id']; ?>','<?php echo $img; ?>','<?php echo $data['response'][$i]['handle']; ?>','<?php echo $rand; ?>','<?php echo ''; ?>','<?php echo $frames[$p]->id; ?>');"><?php echo $data['response'][$i]['title']; ?></a>
                                                                                        <?php } } ?>
                                                                                    </div>
                                                                                  </div>
                                                                                <span id="add" class="choicestep" onclick="addFrame('addCol','<?php echo $frames[$p]->id; ?>');">
                                                                                    <i class="fas fa-plus"></i>
                                                                                </span>
                                                                                <span id="remove" class="choicestep <?php echo $rand ?><?php echo $frames[$p]->id; ?>" onclick="removeFrame('<?php echo $rand; ?>','deleteCol','<?php echo $frames[$p]->id; ?>');">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </span>
                                                                            </div>
                                                                            <br/ id="brC<?php echo $rand; ?><?php echo $frames[$p]->id; ?>">
                                                                            <input type="hidden" id="cid<?php echo $rand; ?><?php echo $frames[$p]->id; ?>">
                                                                          </div>
                                                                          <?php } ?>
                                                                          <div id="addCol<?php echo $frames[$p]->id; ?>"></div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                               </div>
                                               </div>
                                              <?php $srno++; } }

                                              ?>
                                                <div id="addFrameCol"></div>
                                               <?php  /*if(!empty($colorsAll)) {  for($q=0;$q<count($colorsAll);$q++) { 
                                                   
                                                 ?>
                                                 <div class="fcolor<?php echo $colorsAll[$q]->select_frame_id;  ?>" id="frame_col_com<?php echo $colorsAll[$q]->select_frame_id; ?><?php echo $colorsAll[$q]->id; ?>" onclick="show('s4','<?php echo $colorsAll[$q]->id; ?>');"> 
                                                  <div class="steps" id="frameRemove<?php echo $colorsAll[$q]->id; ?>">  <!--stepbox--> 
                                                  <div class="steps-box step-shadow">
                                                 
                                                 <?php  $sectitle=$sec=$sec1= '';  $sec = str_replace("You Choose"," ",$colorsAll[$q]->choose);
                                                  $sec1 = str_replace(" Of "," > ",$sec);
                                                        //$sectitle = 'Secondary Step For'.$sec;
                                                  ?>
                                                   <div id="Fcolormsg<?php echo $colorsAll[$q]->id; ?>" class="Fcolormsg">
                                                    </div>
                                                    <div class="step--title">
                                                        <h3>Secondary Step For <span id="stitle<?php echo $colorsAll[$q]->id; ?>"><?php echo $sec1; ?></span></h3>
                                                      </div>
                                                      <div class="step-no">
                                                          <div class="step-type">
                                                              <i class="far fa-image"></i><!--  <span><?php echo $srno; ?></span> -->
                                                          </div>
                                                      </div>
                                                      <div class="step-content">
                                                          <div class="steprow">
                                                              <div class="step-title">
                                                                    <div onclick="show('s4','<?php echo $colorsAll[$q]->id; ?>');"><textarea class="form-control sr-area" name="" id="choose_Fcolor<?php echo $colorsAll[$q]->id; ?>" rows="1" onkeyup="change_info_Fcolor('<?php echo $colorsAll[$q]->id; ?>');"><?php echo  $colorsAll[$q]->choose; ?></textarea></div>
                                                              </div>
                                                              <div class="step-description">
                                                                  <div onclick="show('s4','<?php echo $colorsAll[$q]->id; ?>');"><textarea class="form-control sr-area" name="" id="choose_desc_Fcolor<?php echo $colorsAll[$q]->id; ?>" rows="1" onkeyup="change_info_Fcolor('<?php echo $colorsAll[$q]->id; ?>');"><?php echo $colorsAll[$q]->choose_desc; ?></textarea></div>
                                                              </div>
                                                              <div class="step-choice w-100 mb-30">
                                                                  <div id="" class="new-choice"> <!-- Repeat columns -->
                                                                      <div class="sc-row">
                                                                          <hr><?php  $ranom = rand();
                                                                          
                                                                          $allFColID = array();
                                                                           $allColorID = array();
                                                                             $colframeSel = DB::select('select * from colors where select_frame_id = '.$colorsAll[$q]->select_frame_id);
                                                                                 for($b=0;$b<count($colframeSel);$b++){
                                                                                    array_push($allColorID,$colframeSel[$b]->frame_id);  
                                                                                  } 
                                                                        
                                                                                $colorsSel = DB::select('select * from frame_cols where sel_color_id='.$colorsAll[$q]->id.' order by sort');
                                                                         
                                                                           if(!empty($colorsSel)) {  
                                                                            for($a=0;$a<count($colorsSel);$a++){
                                                                              array_push($allFColID,$colorsSel[$a]->frame_id);    
                                                                            }
                                                                      for($s=0;$s<count($colorsSel);$s++) { 
                                                                            
                                                                        ?>
                                                                          <div id="main_frame_col<?php echo $colorsSel[$s]->id; ?><?php echo $colorsAll[$q]->id; ?>">
                                                                              <div class="sc-choice FcolorSort<?php echo $colorsAll[$q]->id; ?>" id="FCol<?php echo $colorsSel[$s]->id; echo '_'; ?><?php echo $colorsAll[$q]->id; ?>">
                                                                                <a class="stepsorting" data-scroll="" href="javascript:void(0);">
                                                                                  <span class="fup" onclick="sortUpFrameColor('<?php echo $colorsAll[$q]->id; ?>','<?php echo $colorsAll[$q]->select_frame_id; ?>','<?php echo $colorsSel[$s]->id; ?>');">
                                                                                    <i class="fas fa-angle-up"></i>
                                                                                  </span>
                                                                                  <span class="fdown" onclick="sortDownFrameColor('<?php echo $colorsAll[$q]->id; ?>','<?php echo $colorsAll[$q]->select_frame_id; ?>','<?php echo $colorsSel[$s]->id; ?>');">
                                                                                    <i class="fas fa-angle-down"></i>
                                                                                  </span>
                                                                                </a>
                                                                                  <span class="stepimg">
                                                                                      <div class="imgpreview" id="imgpreviewFCol<?php echo $s; ?><?php echo $colorsAll[$q]->id; ?>" style="background-image: url(<?php echo $colorsSel[$s]->frame_img ?>);"></div>
                                                                                  </span>
                                                                                  <span class="stepbullet">- </span>
                                                                                  <!-- <input class="form-control" placeholder="" value="Traditional"> -->
                                                                                  <div class="dropdown step-drop">
                                                                                      <button  onclick="show('s4','<?php echo $colorsAll[$q]->id; ?>');" class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                            <span id="btntextFCol<?php echo $s; ?><?php echo $colorsAll[$q]->id; ?>"><?php echo $colorsSel[$s]->frame ?> </span>
                                                                                      </button>
                                                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                        <?php 
                                                                                        $frameSel = DB::select('select * from mirrormates where id='.$colorsAll[$q]->select_frame_id);
                                                                                         for($i=0;$i<count($data['response']);$i++) {
                                                                                          if($frameSel[0]->frame_id != $data['response'][$i]['id']){
                                                                                          if(!in_array($data['response'][$i]['id'], $allColorID)){ if(!in_array($data['response'][$i]['id'], $allFColID)) {
                                                                                         $img = '';
                                                                                         $title_str = '';
                                                                                           $title_str = str_replace('"',"quote",$data['response'][$i]['title']);
                                                                                            if(isset($data['response'][$i]['image']['src'])){
                                                                                               $img =$data['response'][$i]['image']['src']; 
                                                                                            }
                                                                                          ?>
                                                                                          <a class="dropdown-item" href="javascript:void(0);" onclick="selFrameColor('<?php echo $title_str; ?>','<?php echo $data['response'][$i]['id']; ?>','<?php echo $img; ?>','<?php echo $data['response'][$i]['handle']; ?>','<?php echo $s; ?>','<?php echo $colorsAll[$q]->id; ?>','<?php echo $colorsAll[$q]->select_frame_id; ?>');"><?php echo $data['response'][$i]['title']; ?></a>
                                                                                          <?php } } } } ?>
                                                                                      </div>
                                                                                    </div>
                                                                                  <span id="add" class="choicestep" onclick="addFrame('addFCol','<?php echo $colorsAll[$q]->id; ?>');">
                                                                                      <i class="fas fa-plus"></i>
                                                                                  </span>
                                                                                  <span id="remove" class="choicestep" onclick="removeFrame('<?php echo $colorsSel[$s]->id; ?>','deleteFCol','<?php echo $colorsAll[$q]->id; ?>');">
                                                                                      <i class="fas fa-minus"></i>
                                                                                  </span>
                                                                              </div>
                                                                              <br/ id="brFC<?php echo $colorsSel[$s]->id; ?><?php echo $colorsAll[$q]->id; ?>">
                                                                              <input type="hidden" id="Fcid<?php echo $s; ?><?php echo $colorsAll[$q]->id; ?>" value="<?php echo $colorsSel[$s]->id; ?>">
                                                                          </div>
                                                                          <?php $ranom++; } } 
                                                                         else { $rand = 'xyz12'; ?>
                                                                           <div id="main_frame_col<?php echo $rand; ?><?php echo $colorsAll[$q]->id; ?>">
                                                                            <div class="sc-choice FcolorSort<?php echo $colorsAll[$q]->id; ?>"  id="FCol<?php echo $rand; ?><?php echo $colorsAll[$q]->id; ?>">
                                                                               <a class="stepsorting" data-scroll="" href="javascript:void(0);">
                                                                                    <span class="fup_col<?php echo $rand ?><?php echo $colorsAll[$q]->id; ?>" onclick="sortUpFrameColor();">
                                                                                      <i class="fas fa-angle-up"></i>
                                                                                    </span>
                                                                                    <span class="fdown_col<?php echo $rand ?><?php echo $colorsAll[$q]->id; ?>" onclick="sortDownFrameColor();">
                                                                                      <i class="fas fa-angle-down"></i>
                                                                                    </span>
                                                                                  </a>
                                                                                <span class="stepimg">
                                                                                    <div class="imgpreview" id="imgpreviewFCol<?php echo $rand; ?><?php echo $colorsAll[$q]->id; ?>" style="background-image: url({{ asset('stepimg.jpg') }})"></div>
                                                                                </span>
                                                                                <span class="stepbullet">- </span>
                                                                                <!-- <input class="form-control" placeholder="" value="Traditional"> -->
                                                                                <div class="dropdown step-drop">
                                                                                    <button  onclick="show('s4','<?php echo $colorsAll[$q]->id; ?>');" class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                          <span id="btntextFCol<?php echo $rand; ?><?php echo $colorsAll[$q]->id; ?>">Select</span>
                                                                                    </button>
                                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                      <?php 
                                                                                      $frameSel = DB::select('select * from mirrormates where id='.$colorsAll[$q]->select_frame_id);
                                                                                         for($i=0;$i<count($data['response']);$i++) {
                                                                                          if($frameSel[0]->frame_id != $data['response'][$i]['id']){
                                                                                          if(!in_array($data['response'][$i]['id'], $allColorID)){ 
                                                                                        if($colorsAll[$q]->frame_id != $data['response'][$i]['id']){ 
                                                                                       $img = '';
                                                                                       $title_str = '';
                                                                                         $title_str = str_replace('"',"quote",$data['response'][$i]['title']);
                                                                                      if(isset($data['response'][$i]['image']['src'])){

                                                                                             $img =$data['response'][$i]['image']['src']; }
                                                                                        ?>
                                                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="selFrameColor('<?php echo $title_str; ?>','<?php echo $data['response'][$i]['id']; ?>','<?php echo $img; ?>','<?php echo $data['response'][$i]['handle']; ?>','<?php echo $rand; ?>','<?php echo $colorsAll[$q]->id; ?>','<?php echo $colorsAll[$q]->select_frame_id; ?>');"><?php echo $data['response'][$i]['title']; ?></a>
                                                                                        <?php } } } } ?>
                                                                                    </div>
                                                                                  </div>
                                                                                <span id="add" class="choicestep" onclick="addFrame('addFCol','<?php echo $colorsAll[$q]->id; ?>');">
                                                                                    <i class="fas fa-plus"></i>
                                                                                </span>
                                                                                <span id="remove" class="choicestep <?php echo $rand ?><?php echo $colorsAll[$q]->id; ?>" onclick="removeFrame('<?php echo $rand; ?>','deleteFCol','<?php echo $colorsAll[$q]->id; ?>');">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </span>
                                                                            </div>
                                                                            <br/ id="brFC<?php echo $rand; ?><?php echo $colorsAll[$q]->id; ?>">
                                                                            <input type="hidden" id="Fcid<?php echo $rand; ?><?php echo $colorsAll[$q]->id; ?>">
                                                                          </div>
                                                                          <?php } ?>
                                                                          <div id="addFCol<?php echo $colorsAll[$q]->id; ?>"></div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                               </div>
                                               </div>
                                              <?php $srno++; } } */ ?> 
                                              <div id="addFC"></div>
                                          </div>
                                          
                                      </div>
                                      <div class="col-6 quiz-bilder" id="right-side-2" style="display: none;">  
                                        <div class="quizb-content padd20">
                                          <div class="quizb-field">
                                            <div class="quizb-field-con">
                                                <div class="input-w-select">
                                                    <div class="iws-title">Background Color</div>
                                                    <div class="iws-input">    
                                                     <input class="form-control" type="color" id="bg_color" value="<?php if(isset($basic_infos[0]->bgcolor)) { echo $basic_infos[0]->bgcolor; }  ?>" name="bgcolor"/>
                                                    </div>
                                                </div>
                                                 <hr class="dot">
                                                <div class="input-w-select">
                                                  <div class="iws-title">Button text</div>
                                                  <div class="iws-input">
                                                      <input  type="text" class="form-control" placeholder="Write text here" value = "<?php if(isset($basic_infos[0]->btn_text)) { echo $basic_infos[0]->btn_text; }  ?>" id="btntext" name="btntext">
                                                  </div>
                                                </div>
                                                 <hr class="dot">
                                                <div class="input-w-select">
                                                    <div class="iws-title">Button Background Color</div>
                                                    <div class="iws-input">
                                                        <input  class="form-control" type="color" id="btncolor" value="<?php if(isset($basic_infos[0]->btn_bgcolor)) { echo $basic_infos[0]->btn_bgcolor; }  ?>" name="btncolor"/>
                                                    </div>
                                                </div>
                                                 <hr class="dot">
                                                 <div class="input-w-select">
                                                    <div class="iws-title">Button Text Color</div>
                                                    <div class="iws-input">    
                                                     <input class="form-control" type="color" id="btn_text_color" value="<?php if(isset($basic_infos[0]->btn_txtcolor)) { echo $basic_infos[0]->btn_txtcolor; }  ?>" name="btntextcolor"/>
                                                    </div>
                                                </div>
                                                 <hr class="dot">
                                                <div class="input-w-select">
                                                    <div class="iws-title">Font Size</div>
                                                    <div class="iws-input">
                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value = "<?php if(isset($basic_infos[0]->btn_font_size)) { echo $basic_infos[0]->btn_font_size; }  ?>" id="fsize" name="fsize">
                                                        <div class="iws-endperson">%</div>
                                                    </div>
                                                </div>
                                                 <hr class="dot">
                                                <div class="input-w-select">
                                                    <div class="iws-title">Border radius</div>
                                                    <div class="iws-input">
                                                        <input class="form-control" type="number" autocomplete="off" value = "<?php if(isset($basic_infos[0]->btn_border_radius)) { echo $basic_infos[0]->btn_border_radius; }  ?>" id="bradius" name="bradius">
                                                        <div class="iws-endperson">%</div>
                                                    </div>
                                                </div>
                                                <hr class="dot">
                                                 <button class="btn btn-bgcolor" onclick="changeSettings('2');">Save</button>
                                                </div>
                                              </div>
                                            </div>             
                                      </div>
                                       <div class="col-6 quiz-bilder" id="right-side-3" style="display: none;">  
                                        <div class="quizb-content padd20">
                                          <div class="quizb-field">
                                            <div class="quizb-field-con">
                                                <div class="input-w-select">
                                                  <div class="iws-title">Next Button text</div>
                                                  <div class="iws-input">
                                                      <input  type="text" class="form-control" placeholder="Write text here" value = "<?php if(isset($basic_infos[0]->next_btntext)) { echo $basic_infos[0]->next_btntext; }  ?>" id="next_btntext" name="next_btntext">
                                                  </div>
                                                </div>
                                                 <hr class="dot">
                                                  <div class="input-w-select">
                                                  <div class="iws-title">Previous Button text</div>
                                                  <div class="iws-input">
                                                      <input  type="text" class="form-control" placeholder="Write text here" value = "<?php if(isset($basic_infos[0]->previous_btntext)) { echo $basic_infos[0]->previous_btntext; }  ?>" id="previous_btntext" name="previous_btntext">
                                                  </div>
                                                </div>
                                                <hr class="dot">
                                                  <div class="input-w-select">
                                                  <div class="iws-title">Show Result Button text</div>
                                                  <div class="iws-input">
                                                      <input  type="text" class="form-control" placeholder="Write text here" value = "<?php if(isset($basic_infos[0]->showresult_btntext)) { echo $basic_infos[0]->showresult_btntext; }  ?>" id="showresult_btntext" name="showresult_btntext">
                                                  </div>
                                                </div>
                                                 <hr class="dot">
                                                <div class="input-w-select">
                                                    <div class="iws-title">Button Background Color</div>
                                                    <div class="iws-input">
                                                        <input  class="form-control" type="color" id="next_btnbgcolor" value="<?php if(isset($basic_infos[0]->next_btnbgcolor)) { echo $basic_infos[0]->next_btnbgcolor; }  ?>" name="next_btnbgcolor"/>
                                                    </div>
                                                </div>
                                                 <hr class="dot">
                                                 <div class="input-w-select">
                                                    <div class="iws-title">Button Text Color</div>
                                                    <div class="iws-input">    
                                                     <input class="form-control" type="color" id="next_btn_text_color" value="<?php if(isset($basic_infos[0]->next_btn_text_color)) { echo $basic_infos[0]->next_btn_text_color; }   ?>" name="next_btn_text_color"/>
                                                    </div>
                                                </div>
                                                 <hr class="dot">
                                                <div class="input-w-select">
                                                    <div class="iws-title">Font Size</div>
                                                    <div class="iws-input">
                                                        <input class="form-control" type="number" autocomplete="off" placeholder="" value = "<?php if(isset($basic_infos[0]->next_fsize)) { echo $basic_infos[0]->next_fsize; }  ?>" id="next_fsize" name="next_fsize">
                                                        <div class="iws-endperson">%</div>
                                                    </div>
                                                </div>
                                                 <hr class="dot">
                                                <div class="input-w-select">
                                                    <div class="iws-title">Border radius</div>
                                                    <div class="iws-input">
                                                        <input class="form-control" type="number" autocomplete="off" value = "<?php if(isset($basic_infos[0]->next_bradius)) { echo $basic_infos[0]->next_bradius; }  ?>" id="next_bradius" name="next_bradius">
                                                        <div class="iws-endperson">%</div>
                                                    </div>
                                                </div>
                                                <hr class="dot">
                                                 <button class="btn btn-bgcolor" onclick="changeSettings('2');">Save</button>
                                                </div>
                                              </div>
                                            </div>             
                                      </div>
                                      <div class="col-6 quiz-preview">
                                          <div class="qp-container" style="background-color:<?php  if(isset($basic_infos[0]->bgcolor)) {  echo $basic_infos[0]->bgcolor; }  ?>">
                                              <div class="qp-full">
                                                  <div id="qp-quiz" class="qp-quiz">
                                                      <section id="s1" class="qp-slide qp-cover">
                                                          <div class="quiz-box">
                                                              <div class="quiz-wrapp">
                                                                  <h1 id="s1_h1"><?php echo $basic_infos[0]->title_1; ?></h1>
                                                                  <p id="s1_p"><?php echo $basic_infos[0]->title_2; ?></p>
                                                                  <div class="lq-group">
                                                                      <button id="btn" class="btn btn" style="font-size:<?php if(isset($basic_infos[0]->btn_font_size)) { echo $basic_infos[0]->btn_font_size; echo 'px'; }  ?>;background-color:<?php if(isset($basic_infos[0]->btn_bgcolor)) { echo $basic_infos[0]->btn_bgcolor;} ?>;color:<?php if(isset($basic_infos[0]->btn_txtcolor)) { echo $basic_infos[0]->btn_txtcolor;} ?>;border-radius:<?php if(isset($basic_infos[0]->btn_border_radius)) { echo $basic_infos[0]->btn_border_radius;; echo 'px'; }  ?>"><?php if(isset($basic_infos[0]->btn_text)) { echo $basic_infos[0]->btn_text; }  ?></button>
                                                                      
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </section>
                                                       <section id="s2" class="qp-slide qp-images qp-cover" style="display: none;">
                                                          <div class="quiz-box">
                                                              <div class="quiz-wrapp">
                                                                  <h1 id="s2_h1"><?php echo $basic_infos[0]->subtitle_1; ?></h1>
                                                                  <p id="s2_p"><?php echo $basic_infos[0]->subtitle_2; ?></p>
                                                                  <div class="quizimg-div" id="fprev">
                                                                      <ul class="quizimg-row" id="selF">
                                                                    <?php   if(!empty($frames)) { for($i=0;$i<count($frames);$i++) { ?>
                                                                    
                                                                          <li id="prevFrame<?php echo $frames[$i]->id; ?>" class="fi">
                                                                              <div class="quizimg-box" style="height: 230px;">
                                                                                  <div class="quizimg-thumb" id="FrameImg<?php echo $i; ?>" style="background-image: url(<?php echo $frames[$i]->frame_img; ?>);"></div>
                                                                                  <div class="quizimg-inner ">
                                                                                      <div class="custom-control custom-checkbox mr-sm-2">
                                                                                      <input class="custom-control-input" type="checkbox" name="checkbox" value="<?php echo $frames[$i]->id; ?>" id="frames_<?php echo $i; ?>"><label class="custom-control-label" id="FrameText<?php echo $i; ?>" for="frames_<?php echo $i; ?>"><?php echo trim($frames[$i]->frame); ?></label>
                                                                                       </div>
                                                                                  </div> 


                                                                              </div>
                                                                          </li>
                                                                      <?php } } else {   $rand = 'abc12'; ?>
                                                                          <li id="prevFrameabc12" class="fi">
                                                                              <div class="quizimg-box">
                                                                                  <div class="quizimg-thumb" id="FrameImg<?php echo $rand; ?>" style="background-image: url({{ asset('stepimg.jpg') }})"></div>
                                                                                  <div class="quizimg-inner">
                                                                                      <div class="custom-control custom-checkbox mr-sm-2">
                                                                                          <input class="custom-control-input" type="checkbox" name="checkbox" id="frames_<?php echo $rand; ?>"><label class="custom-control-label" id="FrameText<?php echo $rand; ?>" for="frames_<?php echo $rand; ?>">Select</label>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </li>
                                                                      <?php } ?>
                                                                       </ul>
                                                                  </div>
                                                                  <div class="steprow">
                                                                    <div class="step-col">

                                                                     <button id="btn4" class="btn btn" style="font-size:<?php if(isset($basic_infos[0]->next_fsize)) { echo $basic_infos[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($basic_infos[0]->next_btnbgcolor)) { echo $basic_infos[0]->next_btnbgcolor;} ?>;color:<?php if(isset($basic_infos[0]->next_btn_text_color)) { echo $basic_infos[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($basic_infos[0]->next_bradius)) { echo $basic_infos[0]->next_bradius; echo 'px'; }  ?>" onclick="previous();"><?php if(isset($basic_infos[0]->previous_btntext)) { echo $basic_infos[0]->previous_btntext; }  ?></button>
                                                                     <button id="btn3" class="btn btn" style="font-size:<?php if(isset($basic_infos[0]->next_fsize)) { echo $basic_infos[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($basic_infos[0]->next_btnbgcolor)) { echo $basic_infos[0]->next_btnbgcolor;} ?>;color:<?php if(isset($basic_infos[0]->next_btn_text_color)) { echo $basic_infos[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($basic_infos[0]->next_bradius)) { echo $basic_infos[0]->next_bradius; echo 'px'; }  ?>" onclick="next();"><?php if(isset($basic_infos[0]->next_btntext)) { echo $basic_infos[0]->next_btntext; }  ?></button>
                                                                   </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </section>
                                                      <?php if(!empty($frames)) { for($i=0;$i<count($frames);$i++) { ?>
                                                        <section id="framep<?php echo $frames[$i]->id; ?>" class="qp-slide qp-color qp-cover framep" style="display: none;">
                                                          <div class="quiz-box">
                                                              <div class="quiz-wrapp">
                                                                <div id="sec_prev_<?php echo $frames[$i]->id; ?>" class="sec_prev">
                                                                   <?php if($i == 0){ ?>
                                                                  <h1 id="selectedFrame"><?php echo $basic_infos[0]->sec_title_1; ?></h1>
                                                                  <p id="selectedFramedesc"><?php echo $basic_infos[0]->sec_title_2; ?></p>
                                                                  <?php } ?>
                                                                </div>
                                                                   <div class="quizcolor-div">
                                                                    <ul class="quizcolor-row" id="frameulp<?php echo $frames[$i]->id; ?>">
                                                                  <?php 
                                                                   $colors = DB::select('select * from colors where select_frame_id='.$frames[$i]->id.' order by sort'); 
                                                                  if(!empty($colors)) {
                                                                  ?>
                                                                        <?php for($j=0;$j<count($colors);$j++){ ?>
                                                                          <li id="prevCol<?php echo $colors[$j]->id; echo $frames[$i]->id; ?>">
                                                                              <div class="quizcolor-box" style="height: 230px;">
                                                                                  <div class="quizcolor-thumb" id="ColImg<?php echo $j; echo $frames[$i]->id; ?>" style="background-image: url(<?php echo $colors[$j]->frame_img; ?>);"></div>
                                                                                  <div class="quizcolor-inner">
                                                                                     
                                                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                                                          <input class="custom-control-input" type="checkbox" value="<?php echo $colors[$j]->id; ?>" name="checkbox" id="frames_cols_<?php echo $j; echo $frames[$i]->id; ?>"><label class="custom-control-label"  id="ColText<?php echo $j; echo $frames[$i]->id; ?>" for="frames_cols_<?php echo $j; echo $frames[$i]->id; ?>"><?php echo trim($colors[$j]->frame); ?></label>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </li>
                                                                        <?php } ?>
                                                                  <?php }  else{ ?>
                                                                          <li id="prevCol<?php echo 'abc12'; echo $frames[$i]->id; ?>">
                                                                              <div class="quizcolor-box">
                                                                                  <div class="quizcolor-thumb" id="ColImg<?php echo 'abc12'; echo $frames[$i]->id; ?>" style="background-image: url({{ asset('stepimg.jpg') }})"></div>
                                                                                  <div class="quizcolor-inner">
                                                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                                                          <input class="custom-control-input" type="checkbox" value="" name="checkbox" id="frames_cols_<?php echo 'abc12'; ?>"><label class="custom-control-label" id="ColText<?php echo 'abc12'; echo $frames[$i]->id; ?>" for="frames_cols_<?php echo 'abc12'; ?>">Select</label>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </li>
                                                                  <?php } ?>
                                                                     </ul>
                                                                  </div>
                                                                  <div class="steprow">
                                                                    <div class="step-col">
                                                                     <button id="btn6" class="btn btn" style="font-size:<?php if(isset($basic_infos[0]->next_fsize)) { echo $basic_infos[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($basic_infos[0]->next_btnbgcolor)) { echo $basic_infos[0]->next_btnbgcolor;} ?>;color:<?php if(isset($basic_infos[0]->next_btn_text_color)) { echo $basic_infos[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($basic_infos[0]->next_bradius)) { echo $basic_infos[0]->next_bradius; echo 'px'; }  ?>" ><?php if(isset($basic_infos[0]->previous_btntext)) { echo $basic_infos[0]->previous_btntext; }  ?></button>
                                                                     <button id="btn5" class="btn btn" style="font-size:<?php if(isset($basic_infos[0]->next_fsize)) { echo $basic_infos[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($basic_infos[0]->next_btnbgcolor)) { echo $basic_infos[0]->next_btnbgcolor;} ?>;color:<?php if(isset($basic_infos[0]->next_btn_text_color)) { echo $basic_infos[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($basic_infos[0]->next_bradius)) { echo $basic_infos[0]->next_bradius; echo 'px'; }  ?>" ><?php if(isset($basic_infos[0]->showresult_btntext)) { echo $basic_infos[0]->showresult_btntext; }  ?></button>
                                                                   </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </section>

                                                      <?php } }?>
                                                      <div id="app_sec"></div>
                                                       <?php /*for($i=0;$i<count($colorsAll);$i++) { ?>
                                                        <section id="frameColp<?php echo $colorsAll[$i]->id; ?>" class="qp-slide qp-color qp-cover frameColp" style="display: none;">
                                                          <div class="quiz-box">
                                                              <div class="quiz-wrapp">
                                                                  <h1 id="selectedFrameCol<?php echo $colorsAll[$i]->id; ?>"><?php echo $colorsAll[$i]->choose; ?></h1>
                                                                  <p id="selectedFramedescCol<?php echo $colorsAll[$i]->id; ?>"><?php echo $colorsAll[$i]->choose_desc; ?></p>
                                                                   <div class="quizcolor-div">
                                                                    <ul class="quizcolor-row" id="framecolulp<?php echo $colorsAll[$i]->id; ?>">
                                                                  <?php 
                                                                   $Framecolors = DB::select('select * from frame_cols where sel_color_id ='.$colorsAll[$i]->id.' order by sort'); 
                                                                  if(!empty($Framecolors)) {
                                                                  ?>
                                                                        <?php for($j=0;$j<count($Framecolors);$j++){ ?>
                                                                          <li id="prevFrameCol<?php echo $Framecolors[$j]->id; echo $colorsAll[$i]->id; ?>" >
                                                                              <div class="quizcolor-box">
                                                                                  <div class="quizcolor-thumb" id="FrameColImg<?php echo $j; echo $colorsAll[$i]->id; ?>" style="background-image: url(<?php echo $Framecolors[$j]->frame_img; ?>);"></div>
                                                                                  <div class="quizcolor-inner">
                                                                                     <span class="quizcolor-radio"></span>
                                                                                      <span class="quizcolor-title" id="FrameColText<?php echo $j; echo $colorsAll[$i]->id; ?>"><?php echo $Framecolors[$j]->frame; ?></span>
                                                                                      
                                                                                     <!--  <div class="custom-control custom-checkbox mr-sm-2">
                                                                                          <input class="custom-control-input" type="checkbox" value="<?php echo $Framecolors[$j]->id; ?>" name="checkbox" id="cols_<?php echo $j; echo $colorsAll[$i]->id; ?>"><label class="custom-control-label" id="FrameColText<?php echo $j; echo $colorsAll[$i]->id; ?>" for="cols_<?php echo $j; echo $colorsAll[$i]->id; ?>"><?php echo trim($Framecolors[$j]->frame); ?></label>
                                                                                      </div> -->
                                                                                  </div>
                                                                              </div>
                                                                          </li>
                                                                        <?php } ?>
                                                                  <?php }else{ ?>
                                                                          <li id="prevFrameCol<?php echo 'xyz12'; echo $colorsAll[$i]->id; ?>">
                                                                              <div class="quizcolor-box">
                                                                                  <div class="quizcolor-thumb" id="FrameColImg<?php echo 'xyz12'; echo $colorsAll[$i]->id; ?>" style="background-image: url({{ asset('stepimg.jpg') }});"></div>
                                                                                  <div class="quizcolor-inner">
                                                                                        <span class="quizcolor-radio"></span>
                                                                                      <span class="quizcolor-title" id="FrameColText<?php echo 'xyz12'; echo $colorsAll[$i]->id; ?>">Select</span>
                                                                                      
                                                                                      <!--  <div class="custom-control custom-checkbox mr-sm-2">
                                                                                          <input class="custom-control-input" type="checkbox" value="" name="checkbox" id="cols_<?php echo 'xyz12'; ?>"><label class="custom-control-label" id="FrameColText<?php echo 'xyz12'; echo $colorsAll[$i]->id; ?>" for="cols_<?php echo 'xyz12'; ?>">select</label>
                                                                                      </div> -->
                                                                                  </div>
                                                                              </div>
                                                                          </li>
                                                                  <?php } ?>
                                                                     </ul>
                                                                  </div>
                                                                  <div class="steprow">
                                                                    <div class="text-left">
                                                                     <button id="btn8" class="btn btn" style="font-size:<?php if(isset($basic_infos[0]->next_fsize)) { echo $basic_infos[0]->next_fsize; echo 'px'; }  ?>;background-color:<?php if(isset($basic_infos[0]->next_btnbgcolor)) { echo $basic_infos[0]->next_btnbgcolor;} ?>;color:<?php if(isset($basic_infos[0]->next_btn_text_color)) { echo $basic_infos[0]->next_btn_text_color;} ?>;border-radius:<?php if(isset($basic_infos[0]->next_bradius)) { echo $basic_infos[0]->next_bradius; echo 'px'; }  ?>" onclick="previous();"><?php if(isset($basic_infos[0]->previous_btntext)) { echo $basic_infos[0]->previous_btntext; }  ?></button>
                                                                   </div> 
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </section>

                                                      <?php } */?>
                                                      <div id="app_sec_col"></div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </section>
                  <div class="modal"><!-- Place at bottom of page --></div>
              </div>
          </div>
    </main>
</html>

<script src="{{ asset('js/jquery-3.2.1.slim.min.js')}}?v=1"></script>
<script src="{{ asset('js/popper.min.js')}}?v=2"></script>
<script src="{{ asset('js/bootstrap.min.js')}}?v=3"></script>
<script src="{{ asset('js/moment.min.js')}}?v=4"></script>
<script src="{{ asset('js/jquery.min.js') }}?v=5"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> 

<script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    function changeSettings(type){
        if(type == 1){
            $('#right-side-1').hide();
            $('#right-side-3').hide();
            $('#right-side-2').show();
             show('s1');
        }
        else if(type == 2){
            $('#right-side-2').hide();
            $('#right-side-3').hide();
            $('#right-side-1').show();
            show('s1');
        }else{
            $('#right-side-2').hide();
            $('#right-side-1').hide();
            $('#right-side-3').show();
            show('s2');
        } 
    }

    $("#bg_color").change(function(){
      var bg_color = $('#bg_color').val();
      var btntext = $('#btntext').val();
      var btncolor = $('#btncolor').val();
      var fsize = $('#fsize').val();
      var bradius = $('#bradius').val();
      var btn_text_color = $('#btn_text_color').val();
      var id = $('#bsicInfoId').val();
      $(".qp-container").css('background-color',$(this).val());
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
         bg_color: bg_color,
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
        var bg_color = $('#bg_color').val();
        var btntext = $('#btntext').val();
        var btncolor = $('#btncolor').val();
        var fsize = $('#fsize').val();
        var bradius = $('#bradius').val();
        var btn_text_color = $('#btn_text_color').val();
        var id = $('#bsicInfoId').val();
        $('#btn').text($(this).val());
         $('#btn1').text($(this).val());
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
           bg_color: bg_color,
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
      var bg_color = $('#bg_color').val();
      var btntext = $('#btntext').val();
      var btncolor = $('#btncolor').val();
      var fsize = $('#fsize').val();
      var bradius = $('#bradius').val();
      var btn_text_color = $('#btn_text_color').val();
      var id = $('#bsicInfoId').val();
      $("#btn").css('background-color',$(this).val());
       $("#btn1").css('background-color',$(this).val());
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
         bg_color: bg_color,
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
      var bg_color = $('#bg_color').val();
      var btntext = $('#btntext').val();
      var btncolor = $('#btncolor').val();
      var fsize = $('#fsize').val();
      var bradius = $('#bradius').val();
      var btn_text_color = $('#btn_text_color').val();
      var id = $('#bsicInfoId').val();
      $("#btn").css('color',$(this).val());
      $("#btn1").css('color',$(this).val());
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
         bg_color: bg_color,
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
      var bg_color = $('#bg_color').val();
      var btntext = $('#btntext').val();
      var btncolor = $('#btncolor').val();
      var fsize = $('#fsize').val();
      var bradius = $('#bradius').val();
      var id = $('#bsicInfoId').val();
      var btn_text_color = $('#btn_text_color').val();
      $("#btn").css('font-size',$(this).val() + 'px');
       $("#btn1").css('font-size',$(this).val() + 'px');
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
         bg_color: bg_color,
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
      var bg_color = $('#bg_color').val();
      var btntext = $('#btntext').val();
      var btncolor = $('#btncolor').val();
      var fsize = $('#fsize').val();
      var bradius = $('#bradius').val();
      var btn_text_color = $('#btn_text_color').val();
      var id = $('#bsicInfoId').val();

      $("#btn").css('border-radius',$(this).val()+'px');
      $("#btn1").css('border-radius',$(this).val()+'px');
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
         bg_color: bg_color,
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

  //next button

  $("#next_btntext").keyup(function(){
        var next_btntext = $('#next_btntext').val();
        var previous_btntext = $('#previous_btntext').val();
        var showresult_btntext = $('#showresult_btntext').val();
        var next_btnbgcolor = $('#next_btnbgcolor').val();
        var next_btn_text_color = $('#next_btn_text_color').val();
        var next_fsize = $('#next_fsize').val();
        var next_bradius = $('#next_bradius').val();
        var id = $('#bsicInfoId').val();
        if(previous_btntext != ''){
          var text = previous_btntext +' / '+next_btntext;
        }
        else{
          var text = next_btntext;
        }
        $('#btn2').text(text);
        $('#btn3').text(next_btntext);
       // $('#btn5').text(next_btntext);
       
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
           next_btntext: next_btntext,
           previous_btntext: previous_btntext,
           next_btnbgcolor: next_btnbgcolor,
           next_btn_text_color: next_btn_text_color,
           next_fsize: next_fsize,
           next_bradius: next_bradius,
           showresult_btntext:showresult_btntext
         },
         cache: false,
         success: function(data){    
         }
       });
    });

 $("#previous_btntext").keyup(function(){
        var previous_btntext = $('#previous_btntext').val();
        var next_btntext = $('#next_btntext').val();
        var showresult_btntext = $('#showresult_btntext').val();
        var next_btnbgcolor = $('#next_btnbgcolor').val();
        var next_btn_text_color = $('#next_btn_text_color').val();
        var next_fsize = $('#next_fsize').val();
        var next_bradius = $('#next_bradius').val();
        var id = $('#bsicInfoId').val();
        if(previous_btntext != ''){
          var text = previous_btntext +' / '+next_btntext;
        }
        else{
          var text = next_btntext;
        }
        $('#btn2').text(text);
        $('#btn4').text(previous_btntext);
          $('#btn6').text(previous_btntext);
            $('#btn8').text(previous_btntext);

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
           next_btntext: next_btntext,
           previous_btntext: previous_btntext,
           next_btnbgcolor: next_btnbgcolor,
           next_btn_text_color: next_btn_text_color,
           next_fsize: next_fsize,
           next_bradius: next_bradius,
           showresult_btntext:showresult_btntext
         },
         cache: false,
         success: function(data){    
         }
       });
    });

  $("#showresult_btntext").keyup(function(){
        var previous_btntext = $('#previous_btntext').val();
        var next_btntext = $('#next_btntext').val();
        var showresult_btntext = $('#showresult_btntext').val();
        var next_btnbgcolor = $('#next_btnbgcolor').val();
        var next_btn_text_color = $('#next_btn_text_color').val();
        var next_fsize = $('#next_fsize').val();
        var next_bradius = $('#next_bradius').val();
        var id = $('#bsicInfoId').val();
       
        //$('#btn3').text(showresult_btntext);
        $('#btn5').text(showresult_btntext);
        
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
           next_btntext: next_btntext,
           previous_btntext: previous_btntext,
           next_btnbgcolor: next_btnbgcolor,
           next_btn_text_color: next_btn_text_color,
           next_fsize: next_fsize,
           next_bradius: next_bradius,
           showresult_btntext:showresult_btntext
         },
         cache: false,
         success: function(data){    
         }
       });
    });

  $("#next_btnbgcolor").change(function(){
      var next_btntext = $('#next_btntext').val();
      var previous_btntext = $('#previous_btntext').val();
      var showresult_btntext = $('#showresult_btntext').val();
        var next_btnbgcolor = $('#next_btnbgcolor').val();
        var next_btn_text_color = $('#next_btn_text_color').val();
        var next_fsize = $('#next_fsize').val();
        var next_bradius = $('#next_bradius').val();
      var id = $('#bsicInfoId').val();
      $("#btn2").css('background-color',$(this).val());
       $("#btn3").css('background-color',$(this).val());
       $('#btn4').css('background-color',$(this).val());
        $('#btn5').css('background-color',$(this).val());
        $('#btn6').css('background-color',$(this).val());
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
          next_btntext: next_btntext,
          previous_btntext: previous_btntext,
           next_btnbgcolor: next_btnbgcolor,
           next_btn_text_color: next_btn_text_color,
           next_fsize: next_fsize,
           next_bradius: next_bradius,
           showresult_btntext:showresult_btntext
       },
       cache: false,
       success: function(data){    
       }
     });
  });

  $("#next_btn_text_color").change(function(){
      var next_btntext = $('#next_btntext').val();
      var previous_btntext = $('#previous_btntext').val();
      var showresult_btntext = $('#showresult_btntext').val();
        var next_btnbgcolor = $('#next_btnbgcolor').val();
        var next_btn_text_color = $('#next_btn_text_color').val();
        var next_fsize = $('#next_fsize').val();
        var next_bradius = $('#next_bradius').val();
      var id = $('#bsicInfoId').val();
      $("#btn2").css('color',$(this).val());
      $("#btn3").css('color',$(this).val());
      $("#btn4").css('color',$(this).val());
      $("#btn5").css('color',$(this).val());
      $("#btn6").css('color',$(this).val());
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
          next_btntext: next_btntext,
          previous_btntext: previous_btntext,
           next_btnbgcolor: next_btnbgcolor,
           next_btn_text_color: next_btn_text_color,
           next_fsize: next_fsize,
           next_bradius: next_bradius,
           showresult_btntext:showresult_btntext
       },
       cache: false,
       success: function(data){    
       }
     });
  });

  $("#next_fsize").change(function(){
     var next_btntext = $('#next_btntext').val();
     var previous_btntext = $('#previous_btntext').val();
     var showresult_btntext = $('#showresult_btntext').val();
        var next_btnbgcolor = $('#next_btnbgcolor').val();
        var next_btn_text_color = $('#next_btn_text_color').val();
        var next_fsize = $('#next_fsize').val();
        var next_bradius = $('#next_bradius').val();
      var id = $('#bsicInfoId').val();
      var btn_text_color = $('#btn_text_color').val();
      $("#btn2").css('font-size',$(this).val() + 'px');
      $("#btn3").css('font-size',$(this).val() + 'px');
      $("#btn4").css('font-size',$(this).val() + 'px');
      $("#btn5").css('font-size',$(this).val() + 'px');
      $("#btn6").css('font-size',$(this).val() + 'px');
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
          next_btntext: next_btntext,
          previous_btntext: previous_btntext,
           next_btnbgcolor: next_btnbgcolor,
           next_btn_text_color: next_btn_text_color,
           next_fsize: next_fsize,
           next_bradius: next_bradius,
           showresult_btntext:showresult_btntext
       },
       cache: false,
       success: function(data){ 

       }
     });
  });

  $("#next_bradius").change(function(){
      var next_btntext = $('#next_btntext').val();
      var previous_btntext = $('#previous_btntext').val();
      var showresult_btntext = $('#showresult_btntext').val();
      var next_btnbgcolor = $('#next_btnbgcolor').val();
      var next_btn_text_color = $('#next_btn_text_color').val();
      var next_fsize = $('#next_fsize').val();
      var next_bradius = $('#next_bradius').val();
      var id = $('#bsicInfoId').val();

      $("#btn2").css('border-radius',$(this).val()+'px');
      $("#btn3").css('border-radius',$(this).val()+'px');
      $("#btn4").css('border-radius',$(this).val()+'px');
      $("#btn5").css('border-radius',$(this).val()+'px');
      $("#btn6").css('border-radius',$(this).val()+'px');
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
          next_btntext: next_btntext,
          previous_btntext: previous_btntext,
          next_btnbgcolor: next_btnbgcolor,
          next_btn_text_color: next_btn_text_color,
          next_fsize: next_fsize,
          next_bradius: next_bradius,
          showresult_btntext:showresult_btntext
       },
       cache: false,
       success: function(data){    
       }
     });
  });

  function change_info(fid){
    var choose = $('#choose').val();
    var choose_desc = $('#choose_desc').val();
    $('#selectedFrame').text(choose);
     $('#selectedFramedesc').text(choose_desc);
    var url = $('#change_info').val()+'/'+fid;
      $.ajax({
        url: url,
        type: "POST",
        dataType: "JSON",
        data: {
         _token: "{{ csrf_token() }}",
         choose:choose,
         choose_desc:choose_desc
         },
         cache: false,
         success: function(data){    
         }
      });
  }

  function change_info_Fcolor(cid){
    var choose = $('#choose_Fcolor'+cid).val();
    var choose_desc = $('#choose_desc_Fcolor'+cid).val();
    $('#selectedFrameCol'+cid).text(choose);
     $('#selectedFramedescCol'+cid).text(choose_desc);
    var url = $('#change_info_col').val()+'/'+cid;
      $.ajax({
        url: url,
        type: "POST",
        dataType: "JSON",
        data: {
         _token: "{{ csrf_token() }}",
         choose:choose,
         choose_desc:choose_desc
         },
         cache: false,
         success: function(data){    
         }
      });
  }

  $("#title_1").keyup(function(){
      var title_1 = $('#title_1').val();
      var title_2 = $('#title_2').val();
      var subtitle_1 = $('#subtitle_1').val();
      var subtitle_2 = $('#subtitle_2').val();
      var id = $('#bsicInfoId').val();
      $('#s1_h1').text($(this).val());
      if(id == 0){
        var add_url =  $('#addbasic').val();
        var  url = add_url;
      }else{
        var edit_url =  $('#editbasic').val();
        var  url = edit_url+'/'+id;
      }

      $.ajax({
        url: url,
        type: "POST",
        dataType: "JSON",
        data: {
         _token: "{{ csrf_token() }}",
         title_1:title_1,
         title_2:title_2,
         subtitle_1:subtitle_1,
         subtitle_2:subtitle_2
       },
       cache: false,
       success: function(data){    
       }
     });
  });

  $("#title_2").keyup(function(){
      var title_1 = $('#title_1').val();
      var title_2 = $('#title_2').val();
      var subtitle_1 = $('#subtitle_1').val();
      var subtitle_2 = $('#subtitle_2').val();
      var id = $('#bsicInfoId').val();
      $('#s1_p').text($(this).val());
      if(id == 0){
        var add_url =  $('#addbasic').val();
        var  url = add_url;
      }else{
        var edit_url =  $('#editbasic').val();
        var  url = edit_url+'/'+id;
      }

      $.ajax({
        url: url,
        type: "POST",
        dataType: "JSON",
        data: {
         _token: "{{ csrf_token() }}",
         title_1:title_1,
         title_2:title_2,
         subtitle_1:subtitle_1,
         subtitle_2:subtitle_2
       },
       cache: false,
       success: function(data){    
       }
     });
  });

  $("#subtitle_1").keyup(function(){
      var title_1 = $('#title_1').val();
      var title_2 = $('#title_2').val();
      var subtitle_1 = $('#subtitle_1').val();
      var subtitle_2 = $('#subtitle_2').val();
      var id = $('#bsicInfoId').val();
      $('#s2_h1').text($(this).val());
      if(id == 0){
        var add_url =  $('#addbasic').val();
        var  url = add_url;
      }else{
        var edit_url =  $('#editbasic').val();
        var  url = edit_url+'/'+id;
      }

      $.ajax({
        url: url,
        type: "POST",
        dataType: "JSON",
        data: {
         _token: "{{ csrf_token() }}",
         title_1:title_1,
         title_2:title_2,
         subtitle_1:subtitle_1,
         subtitle_2:subtitle_2
       },
       cache: false,
       success: function(data){    
       }
     });
  });

  $("#subtitle_2").keyup(function(){
      var title_1 = $('#title_1').val();
      var title_2 = $('#title_2').val();
      var subtitle_1 = $('#subtitle_1').val();
      var subtitle_2 = $('#subtitle_2').val();
      var id = $('#bsicInfoId').val();
      $('#s2_p').text($(this).val());
      if(id == 0){
        var add_url =  $('#addbasic').val();
        var  url = add_url;
      }else{
        var edit_url =  $('#editbasic').val();
        var  url = edit_url+'/'+id;
      }

      $.ajax({
        url: url,
        type: "POST",
        dataType: "JSON",
        data: {
         _token: "{{ csrf_token() }}",
         title_1:title_1,
         title_2:title_2,
         subtitle_1:subtitle_1,
         subtitle_2:subtitle_2
       },
       cache: false,
       success: function(data){    
       }
     });
  });

  function ColorSelection(){
    show('s2','');
  }

  function colors(fid){
      show('s3',fid);
  }

  function colors_frame(fid){
      show('s4',fid);
  }

  function redirectColor(handle){
      var url="https://mirrormate-staging.myshopify.com/collections/"+handle;
       window.top.location =url;
  }

   function selFrame(title,frameid,frameimg,handle,j,mmId){
     var check_frame = $('#check_frame').val();
     var quizId = $('#quiz_id').val();
       $.ajax({
            url: check_frame,
            type: "POST",
            dataType: "JSON",
            data: {
               _token: "{{ csrf_token() }}",
                frameid: frameid,
                quizId:quizId
              
            },
            cache: false,
            success: function(data){  
                if(data == '') {
                      var title1 = title.replace("quote", '"');
                      var fTitle = title1.replace(/[#_]/g,' ');
                      $('#btntext'+j).text(fTitle);
                      $('#imgpreview'+j).css("background-image", "url(" + frameimg + ")"); 
                      $('#FrameImg'+j).css("background-image", "url(" + frameimg + ")"); 
                      $('#FrameText'+j).text(fTitle);
                      var fid = $('#fid'+j).val();
                      if (fid == ''){
                         var add_url = $('#add_url').val();
                         var url = add_url; 
                         $('#framemsg').text('');
                         $('#framemsg').text('Frame Inserted');
                          $('#framemsg').removeClass('alert-msg-danger text-center');
                         $('#framemsg').addClass('alert-msg-success text-center');
                         setTimeout(function() { $("#framemsg").text(''); }, 3000);


                      }else{
                        var edit_url = $('#update_url').val();
                         var url = edit_url+'/'+fid;
                         $('#framemsg').text('');
                         $('#framemsg').text('Frame Updated');
                          $('#framemsg').removeClass('alert-msg-danger text-center');
                         $('#framemsg').addClass('alert-msg-success text-center');
                         setTimeout(function() { $("#framemsg").text(''); }, 3000);
                      }
                      var quizId = $('#quiz_id').val();
                        $.ajax({
                              url: url,
                              type: "POST",
                              dataType: "JSON",
                              data: {
                                 _token: "{{ csrf_token() }}",
                                  mmId:mmId,
                                  title: title,
                                  frameid: frameid,
                                  frameimg: frameimg,
                                  handle:handle,
                                  quizId:quizId
                              },
                              cache: false,
                              success: function(data1){ 
                                if(fid == ''){
                                  //alert(data1.frameid1);
                                  
                                  $('#addFrameCol').before(data1.addFrameCol);
                                  $('#app_sec').append(data1.frameColPrev);
                                  $('#FrameImg'+j).attr('data-id',data1.insertedId);
                                  $('#main'+j).attr('id','main'+data1.insertedId);
                                  $('#'+j).attr('id',data1.insertedId);
                                  $('.fup'+j).removeAttr('onclick'); 
                                  $('.fup'+j).attr('onClick','sortUpFrame('+data1.insertedId+')');
                                  $('.fdown'+j).removeAttr('onclick'); 
                                  $('.fdown'+j).attr('onClick','sortDownFrame('+data1.insertedId+')');
                                  $('.'+j).removeAttr('onclick'); 
                                  $('.'+j).attr('onClick','removeFrame('+data1.insertedId+')');
                                  $('#prevFrame'+j).attr('id','prevFrame'+data1.insertedId);
                                  $('#brF'+j).attr('id','brF'+data1.insertedId);
                                  $('#fid'+j).val(data1.insertedId);
                                  if(data1.frameid1 != ''){
                                   // alert(data1.sec);
                                    $('.sec').html('');
                                    $('#sec_'+data1.frameid1).append(data1.sec);
                                    $('.sec_prev').html('');
                                    $('#sec_prev_'+data1.frameid1).append(data1.secPrev);
                                  } 
                                 // $('#prevFrame'+data1.insertedId).attr('onClick','colors('+data1.insertedId+')');
                                
                              }
                              else{
                                    $('#choose'+fid).val(data1.data.choose);
                                    $('#prevFrame'+mmId).removeAttr('onclick');
                                   // $('#prevFrame'+mmId).attr('onClick','colors('+data1.data.id+')');
                                    $('#selectedFrame'+mmId).text(data1.data.choose);
                                    $('#choose'+fid).val(data1.data.choose);
                                    $('#stitile'+fid).text(data1.data.frame);
                                    $('#selectedFrame'+fid).text(data1.data.choose);
                                    for(var i=0;i<data1.allColorId.length;i++){
                                        //alert(data1.allColorId[i]);
                                        $('#stitle'+data1.allColorId[i]).text(data1.allColorChoose1[i]);
                                        $('#choose_Fcolor'+data1.allColorId[i]).val('You Choose '+data1.allColorChoose2[i]);
                                        $('#selectedFrameCol'+data1.allColorId[i]).text('You Choose '+data1.allColorChoose2[i]);
                                    }
                                  }
                            }
                          });
                }else{
                    alert(data+' is Already Selected..')
                }
            }
        }); 

    }

    function selColor(title,frameid,frameimg,handle,j,cId,mmId){
       var check_Color = $('#check_Color').val();
      $.ajax({
          url: check_Color,
          type: "POST",
          dataType: "JSON",
          data: {
             _token: "{{ csrf_token() }}",
              frameid: frameid,
              select_frame_id:mmId
            
          },
          cache: false,
          success: function(data){  
              if(data == '') {
                  var title1 = title.replace("quote", '"');
                    var fTitle = title1.replace(/[#_]/g,' ');
                  $('#btntextCol'+j+mmId).text(fTitle);
                  $('#imgpreviewCol'+j+mmId).css("background-image", "url(" + frameimg + ")"); 
                  $('#ColText'+j+mmId).text(fTitle);
                  $('#ColImg'+j+mmId).css("background-image", "url(" + frameimg + ")"); 
                  var cid = $('#cid'+j+mmId).val();
                  if (cid == ''){
                     var add_url = $('#addcolor_url').val();
                     var url = add_url;
                      $('.colormsg').text('');
                      $('#colormsg'+mmId).text('Frame Inserted');
                      $('#colormsg'+mmId).removeClass('alert-msg-danger text-center ');
                      $('#colormsg'+mmId).addClass('alert-msg-success text-center colormsg');
                     setTimeout(function() { $("#colormsg"+mmId).text(''); }, 3000);
                  }else{
                    var edit_url = $('#editcolor_url').val();
                     var url = edit_url+'/'+cid;
                     $('.colormsg').text('');
                      $('#colormsg'+mmId).text('Frame Updated');
                      $('#colormsg'+mmId).removeClass('alert-msg-danger text-center ');
                      $('#colormsg'+mmId).addClass('alert-msg-success text-center colormsg');
                     setTimeout(function() { $("#colormsg"+mmId).text(''); }, 3000);
                  }
                  var quizId = $('#quiz_id').val();
                   $.ajax({
                      url: url,
                      type: "POST",
                      dataType: "JSON",
                      data: {
                         _token: "{{ csrf_token() }}",
                          id:cId,
                          select_frame_id:mmId,
                          title: title,
                          frameid: frameid,
                          frameimg: frameimg,
                          handle:handle,
                          quizId:quizId
                      },
                      cache: false,
                      success: function(data1){
                        if(cid == ''){
                          var deleteCol = 'deleteCol';
                          //$('#addFC').before(data1.addFrameCol);
                          //$('#app_sec_col').append(data1.frameColPrev);
                         $('#imgpreviewCol'+j+mmId).attr('data-id',data1.data.id);  
                        // alert(data1.data.select_frame_id); 
                         show('s3',data1.data.select_frame_id);
                          //$('#prevCol'+j+mmId).attr('onClick','colors_frame("'+data1.data.id+'")');
                         $('#main_col'+j+mmId).attr('id','main_col'+data1.data.id+data1.data.select_frame_id);
                          $('#Col'+j+mmId).removeAttr('class');
                         $('#Col'+j+mmId).attr('class','sc-choice colorSort'+data1.data.select_frame_id);
                         $('#brC'+j+mmId).attr('id','brC'+data1.data.id);
                          $('.fup'+j+mmId).removeAttr('onclick'); 
                          $('.fup'+j+mmId).attr('onClick','sortUpColor('+data1.data.id+','+data1.data.select_frame_id+')');
                          $('.fdown'+j+mmId).removeAttr('onclick'); 
                          $('.fdown'+j+mmId).attr('onClick','sortDownColor('+data1.data.id+','+data1.data.select_frame_id+')');
                          $('#prevCol'+j+mmId).attr('id','prevCol'+data1.data.id+data1.data.select_frame_id);
                          $('.'+j+mmId).removeAttr('onclick'); 
                          $('.'+j+mmId).attr('onClick','removeFrame('+data1.data.id+',"'+deleteCol+'",'+data1.data.select_frame_id+')');
                          $('#Col'+j+mmId).attr('id','Col'+data1.data.id+'_'+data1.data.select_frame_id);
                          $('#cid'+j+mmId).val(data1.data.id);
                        }else{
                          $('#prevCol'+cId+mmId).removeAttr('onclick');
                         // $('#prevCol'+cId+mmId).attr('onClick','colors_frame("'+data1.data.id+'")');
                          $('#choose_Fcolor'+cid).val(data1.data.choose);
                          $('#selectedFrameCol'+cid).text(data1.data.choose);
                          $('#stitle'+cid).text(data1.Fchoose);
                        }
                      }
                  });
              }else{
                  alert(data+' is Already Selected..')
              }
          }
      }); 
    }

    function selFrameColor(title,frameid,frameimg,handle,j,cId,mmId){
      var check_FColor = $('#check_FColor').val();
      $.ajax({
          url: check_FColor,
          type: "POST",
          dataType: "JSON",
          data: {
             _token: "{{ csrf_token() }}",
              frameid: frameid,
              select_frame_id:mmId
            
          },
          cache: false,
          success: function(data){  
            if(data == ''){
                  var title1 = title.replace("quote", '"');
                    var fTitle = title1.replace(/[#_]/g,' ');

                  $('#btntextFCol'+j+cId).text(fTitle);
                  $('#imgpreviewFCol'+j+cId).css("background-image", "url(" + frameimg + ")"); 
                  $('#FrameColText'+j+cId).text(fTitle);
                  $('#FrameColImg'+j+cId).css("background-image", "url(" + frameimg + ")"); 
                  var cid = $('#Fcid'+j+cId).val();
                  if (cid == '' || cid == undefined){
                     var add_url = $('#frame_col_add').val();
                     var url = add_url;
                      $('.Fcolormsg').text('');
                      $('#Fcolormsg'+cId).text('Frame Inserted');
                      $('#Fcolormsg'+cId).removeClass('alert-msg-danger text-center ');
                      $('#Fcolormsg'+cId).addClass('alert-msg-success text-center Fcolormsg');
                     setTimeout(function() { $("#Fcolormsg"+cId).text(''); }, 3000);
                  }else{
                    var edit_url = $('#frame_col_edit').val();
                     var url = edit_url+'/'+cid;
                     $('.Fcolormsg').text('');
                      $('#Fcolormsg'+cId).text('Frame Updated');
                      $('#Fcolormsg'+cId).removeClass('alert-msg-danger text-center ');
                      $('#Fcolormsg'+cId).addClass('alert-msg-success text-center Fcolormsg');
                     setTimeout(function() { $("#Fcolormsg"+cId).text(''); }, 3000);
                  }
                   $.ajax({
                      url: url,
                      type: "POST",
                      dataType: "JSON",
                      data: {
                         _token: "{{ csrf_token() }}",
                          sel_color_id:cId,
                          sel_frame_id:mmId,
                          frame: title,
                          frame_id: frameid,
                          frame_img: frameimg,
                          handle:handle
                      },
                      cache: false,
                      success: function(data1){
                        if(cid == '' || cid == undefined){
                          var deleteCol = 'deleteFCol';
                         $('#imgpreviewFCol'+j+mmId).attr('data-id',data1.data.id);   
                         show('s4',data1.data.sel_color_id);
                          //$('#prevFrameCol'+j+cId).attr('onClick','redirectColor("'+data1.data.handle+'")');
                         $('#main_frame_col'+j+cId).attr('id','main_frame_col'+data1.data.id+data1.data.sel_color_id);
                         $('#brFC'+j+mmId).attr('id','brC'+data1.data.id);
                          $('.fup_col'+j+cId).removeAttr('onclick'); 
                          $('.fup_col'+j+cId).attr('onClick','sortUpFrameColor('+data1.data.sel_color_id+','+data1.data.sel_frame_id+','+data1.data.id+')');
                          $('.fdown_col'+j+cId).removeAttr('onclick'); 
                          $('.fdown_col'+j+cId).attr('onClick','sortDownFrameColor('+data1.data.sel_color_id+','+data1.data.sel_frame_id+','+data1.data.id+')');
                          $('#prevFrameCol'+j+mmId).attr('id','prevFrameCol'+data1.data.id+data1.data.sel_color_id);
                          $('#prevFrameCol'+j+cId).attr('id','prevFrameCol'+data1.data.id+data1.data.sel_color_id);
                          $('.'+j+cId).removeAttr('onclick'); 
                          $('.'+j+cId).attr('onClick','removeFrame('+data1.data.id+',"'+deleteCol+'",'+data1.data.sel_color_id+')');
                          $('#FCol'+j+cId).attr('id','FCol'+data1.data.id+'_'+data1.data.sel_color_id);
                          $('#Fcid'+j+cId).val(data1.data.id);
                        }else{
                          $('#prevFrameCol'+cid+cId).removeAttr('onclick');
                         // $('#prevFrameCol'+cid+cId).attr('onClick','redirectColor("'+data1.data.handle+'")');
                        }
                      }

                  });
              }else{
                  alert(data+' is Already Selected..')
                 }
          }
      }); 
    }
  
    function removeFrame(id,type,frameid){
      if(confirm('Are You Sure?')) {  
          if(type == 'deleteCol'){
            $('#main_col'+id+frameid).remove();
            $('#prevCol'+id+frameid).remove();
            $('#frame_col_com'+frameid+id).remove();
            var delete_url = $('#deletecolor_url').val();
             var url = delete_url+'/'+id+'/'+frameid;
          }
          else if(type == 'deleteFCol'){
              $('#main_frame_col'+id+frameid).remove();
              $('#prevFrameCol'+id+frameid).remove();
              var delete_url = $('#deleteFcolor_url').val();
              var url = delete_url+'/'+id+'/'+frameid;
          }else{
            $('#main'+id).remove();
            $('#prevFrame'+id).remove();
            $('.fcolor'+id).remove();
            var delete_url = $('#delete_url').val();
            var url = delete_url+'/'+id;
             $('#frameRemove'+id).remove();   
          }
      
          var quizId = $('#quiz_id').val();
           $.ajax({
                url: url,
                type: "POST",
                dataType: "JSON",
                data: {
                   _token: "{{ csrf_token() }}",
                    id:id,
                    quizId:quizId
                },
                cache: false,
                 beforeSend:     
                  function() {    
                  isProcessing = true;
                      $body = $("body");
                      $body.addClass("loading");    
                  },
                 success: function(data1){  
                  $body.removeClass("loading");
                   
                    if(type == 'deleteCol'){
                      $('#Col'+id).html('');
                       $('#Col'+id+frameid).hide();
                       $('#frame_col_com'+frameid+id).hide();
                         show('s3',frameid);
                        $('#addCol'+frameid).before(data1.Col);
                        $('#frameulp'+frameid).append(data1.ColPrev);
                         $('.colormsg').text('');
                       $('#colormsg'+frameid).text('Frame Deleted');
                        $('#colormsg'+frameid).removeClass('alert-msg-success text-center ');
                       $('#colormsg'+frameid).addClass('alert-msg-danger text-center colormsg');
                       setTimeout(function() { $("#colormsg"+frameid).text(''); }, 3000);

                    }if(type == 'deleteFCol'){
                      $('#FCol'+id).html('');
                       $('#FCol'+id+frameid).hide();
                        show('s4',frameid);
                        $('#addFCol'+frameid).before(data1.Col);
                        $('#framecolulp'+frameid).append(data1.ColPrev);
                        $('.Fcolormsg').text('');
                       $('#Fcolormsg'+frameid).text('Frame Deleted');
                        $('#Fcolormsg'+frameid).removeClass('alert-msg-success text-center ');
                       $('#Fcolormsg'+frameid).addClass('alert-msg-danger text-center colormsg');
                       setTimeout(function() { $("#Fcolormsg"+frameid).text(''); }, 3000);
                    }
                    else{
                        $('.sec').html('');
                        $('#sec_'+data1.frameId).append(data1.sec);
                        $('.sec_prev').html('');
                        $('#sec_prev_'+data1.frameId).append(data1.secPrev);
                        $('#addFrame').before(data1.frame);
                        $('#selF').append(data1.framePrev);
                         $('#framemsg').text('');
                       $('#framemsg').text('Frame Deleted');
                        $('#framemsg').removeClass('alert-msg-success text-center');
                       $('#framemsg').addClass('alert-msg-danger text-center');
                       setTimeout(function() { $("#framemsg").text(''); }, 3000);
                    }
                }
            });
        }
    }

    function addFrame(type,FId){
        var  appendFrame = $('#appendFrame').val();
        var quizId = $('#quiz_id').val();
       if(FId == undefined){
          FId = '';
       }
        $.ajax({
              url: appendFrame,
              type: "POST",
              dataType: "JSON",
              data: {
                 _token: "{{ csrf_token() }}",
                 type:type,
                 FId:FId,
                 quizId:quizId

              },
              cache: false,
              success: function(data1){  
                if(type == 'addFrame'){
                   $('#'+type).before(data1.addCol);
                   $('#selF').append(data1.previewFrame);
                }else if(type == 'addFCol'){
                    show('s4',data1.frameid);
                    $('#'+type+FId).before(data1.addCol);
                    $('#framecolulp'+FId).append(data1.previewFrame);
                 
                }else{
                 show('s3',data1.frameid);
                  $('#'+type+FId).before(data1.addCol);
                   $('#frameulp'+FId).append(data1.previewFrame);
                 
                }
                
              }
          });       
    }

    function show(id,FId){
        if(id == 's1'){
           $('#s2').hide();
           $('.framep').hide();
           $('.frameColp').hide();
           $('#'+id).show();
        }else if(id == 's2'){
            $('#s1').hide();
            $('.framep').hide();
            $('.frameColp').hide();
            $('#'+id).show();
        }else if(id == 's3'){
            $('#s1').hide();
            $('#s2').hide();
            $('.framep').hide();
            $('.frameColp').hide();
            $('#framep'+FId).show();
        }else if(id == 's4'){
            $('#s1').hide();
            $('#s2').hide();
            $('.framep').hide();
            $('.frameColp').hide();
            $('#frameColp'+FId).show();
        }
        if(FId == 'fPreview'){
             var url = $('#framePrev').val();
             var quizId = $('#quiz_id').val();
             $.ajax({
              url: url,
              type: "POST",
              dataType: "JSON",
              data: {
                 _token: "{{ csrf_token() }}",
                 quizId:quizId
              },
              cache: false,
              success: function(data){ 
                  $('#fprev').html('');
                  $('#fprev').append(data);
              }
          });
        }
    }
    
    function sortUpFrame(id){
        var sortingFrame = $('#sortingFrame').val();
        var currentrow = jQuery('#main'+id).closest("div");
        var brid = $('#main'+id).prev('div').attr('id');
        jQuery('#'+brid).insertAfter(currentrow);

        var currentrow1 = jQuery('#frame_col'+id).closest("div");
        var brid1 = $('#frame_col'+id).prev('div').attr('id');
        jQuery('#'+brid1).insertAfter(currentrow1);

        var currentrow2 = jQuery('.fcolor'+id).closest("div");
        var brid2 = $('.fcolor'+id).prev('div').attr('id');
        jQuery('#'+brid2).insertAfter(currentrow2);

        var arr = [];
        $(".frameSort").each(function() {
            arr.push(this.id);
        });
        $.ajax({
            type: 'POST',
            url: sortingFrame,
            data: {
               _token: "{{ csrf_token() }}",
              arr:arr
            },
            dataType: 'html',
            success: function (data)
            {
                show(s2,'fPreview');
            }
        });   
    }

  function sortDownFrame(id){
     var sortingFrame = $('#sortingFrame').val();
      var currentrow = jQuery('#main'+id).closest("div");
      var brid = $('#main'+id).next('div').attr('id');
      jQuery('#'+brid).insertBefore(currentrow);

      var currentrow1 = jQuery('#frame_col'+id).closest("div");
      var brid1 = $('#frame_col'+id).next('div').attr('id');
      jQuery('#'+brid1).insertBefore(currentrow1);

      var currentrow2 = jQuery('.fcolor'+id).closest("div");
      var brid2 = $('.fcolor'+id).next('div').attr('id');
      jQuery('#'+brid2).insertBefore(currentrow2);

      var arr = [];
      $(".frameSort").each(function() {
          arr.push(this.id);
      });
      $.ajax({
          type: 'POST',
          url: sortingFrame,
          data: {
             _token: "{{ csrf_token() }}",
            arr:arr
          },
          dataType: 'html',
          success: function (data)
          {
              show(s2,'fPreview');
          }
      });
  }

  function showColor(frameid){
        var url = $('#sel_col').val();
           $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            data: { 
               _token: "{{ csrf_token() }}",
                frameid:frameid

            },
            cache: false,
            success: function(data){ 
              $('#frameulp'+frameid).html(' ');
              $('#frameulp'+frameid).append(data.addSelCol);
            }
        });        
  }

  function showFrameColor(frameid,colorid){
        var url = $('#sel_frame_col').val();
           $.ajax({
            url: url,
            type: "POST",
            dataType: "JSON",
            data: { 
               _token: "{{ csrf_token() }}",
                frameid:frameid,
                colorid:colorid

            },
            cache: false,
            success: function(data){ 
              $('#framecolulp'+colorid).html(' ');
              $('#framecolulp'+colorid).append(data.addSelCol);
            }
        });   
    }

    function sortUpColor(colorid,frameid){
      var sortingColor = $('#sortingColor').val();
        var currentrow = jQuery('#main_col'+colorid+frameid).closest("div");
        var brid = $('#main_col'+colorid+frameid).prev('div').attr('id');
        jQuery('#'+brid).insertAfter(currentrow); 

        var currentrow1 = jQuery('#frame_col_com'+frameid+colorid).closest("div");
        var brid1 = $('#frame_col_com'+frameid+colorid).prev('div').attr('id');
       	$('#'+brid1).insertAfter(currentrow1);
         var arr = [];
         var cid = [];
        $(".colorSort"+frameid).each(function() {
            var id = this.id;
            cid = id.split('_');
            var final_id = cid[0].replace('Col','');
            arr.push(final_id);
        });
        $.ajax({
            type: 'POST',
            url: sortingColor,
            data: {
               _token: "{{ csrf_token() }}",
                arr:arr,
                frameid:frameid
            },
            dataType: 'html',
            success: function (data)
            {
                showColor(frameid);
            }
        });  
    }

   function sortUpFrameColor(colorid,frameid,selfColorid){
    var sortingFrameColor = $('#sortingFrameColor').val();
      var currentrow = jQuery('#main_frame_col'+selfColorid+colorid).closest("div");
      var brid = $('#main_frame_col'+selfColorid+colorid).prev('div').attr('id');
     
      jQuery('#'+brid).insertAfter(currentrow); 
       var arr = [];
       var cid = [];
      $(".FcolorSort"+colorid).each(function() {
          var id = this.id;
          cid = id.split('_');
          var final_id = cid[0].replace('FCol','');
          arr.push(final_id);
      });
      $.ajax({
          type: 'POST',
          url: sortingFrameColor,
          data: {
             _token: "{{ csrf_token() }}",
              arr:arr,
              frameid:frameid,
              colorid:colorid
          },
          dataType: 'html',
          success: function (data)
          {
              showFrameColor(frameid,colorid);
          }
      });  
  }

  function sortDownFrameColor(colorid,frameid,selfColorid){
    	var sortingFrameColor = $('#sortingFrameColor').val();
      var currentrow = jQuery('#main_frame_col'+selfColorid+colorid).closest("div");
      var brid = $('#main_frame_col'+selfColorid+colorid).next('div').attr('id');
      jQuery('#'+brid).insertBefore(currentrow); 
       var arr = [];
       var cid = [];
      $(".FcolorSort"+colorid).each(function() {
          var id = this.id;
          cid = id.split('_');
          var final_id = cid[0].replace('FCol','');
          arr.push(final_id);
      });
      $.ajax({
          type: 'POST',
          url: sortingFrameColor,
          data: {
             _token: "{{ csrf_token() }}",
              arr:arr,
              frameid:frameid,
              colorid:colorid
          },
          dataType: 'html',
          success: function (data)
          {
              showFrameColor(frameid,colorid);
          }
      });    
  }

  function sortDownColor(colorid,frameid){
    var sortingColor = $('#sortingColor').val();
      var currentrow = jQuery('#main_col'+colorid+frameid).closest("div");
      var brid = $('#main_col'+colorid+frameid).next('div').attr('id');
      jQuery('#'+brid).insertBefore(currentrow); 

      var currentrow1 = jQuery('#frame_col_com'+frameid+colorid).closest("div");
      var brid1 = $('#frame_col_com'+frameid+colorid).next('div').attr('id');
     	$('#'+brid1).insertBefore(currentrow1);


       var arr = [];
      $(".colorSort"+frameid).each(function() {
          var id = this.id;
          cid = id.split('_');
          var final_id = cid[0].replace('Col','');
          arr.push(final_id);
      });
      $.ajax({
          type: 'POST',
          url: sortingColor,
          data: {
             _token: "{{ csrf_token() }}",
              arr:arr,
              frameid:frameid
          },
          dataType: 'html',
          success: function (data)
          {
              showColor(frameid);
          }
      });  
  }

  function filter(id,fid,type) {
    var input, filter, ul, li, a, i;
    input = document.getElementById("txtSearchValue_"+id+fid+type);
    filter = input.value.toUpperCase();
    $('.drop-name'+id+fid+type).find('a').each(function(e) { 
        txtValue = this.textContent || this.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          this.style.display = "";
        } else {
          this.style.display = "none";
        }
    });
  }
/*
   $(document).ready( function(){
      function equalHeight(){
          var heightArray = $(".quizimg-box").map( function(){
                   return  $(this).height();
                   }).get();
          var maxHeight = Math.max.apply( Math, heightArray);
          $(".quizimg-box").height(maxHeight);
              }
      equalHeight();
  });*/
</script>
