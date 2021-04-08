<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mirrormate;
use App\Color;
use App\basicInfo;
use App\frame_col;
use DB;
use App\Http\Resources\mirrormate as MirrormateResources;
use App\Http\Resources\basicInfo as BasicInfoResources;

use Session;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() 
    {
      $this->username='a7acdbe5d4d00f7537f7292aa226df09';
      $this->password = '69e8f92992dbb9056c994d882066aa6d';
      ini_set('display_errors',1);
      error_reporting(E_ALL);
    }

    public function index(Request $request,$quizId)
    {
            //echo "Hii";die;
        
        //Session::put('total',1);
            $selFrame = array();
             //$quizId = Session::get('quizId');
             //echo $quizId;die;
             $frames = DB::select('select * from mirrormates where quiz_id = '.$quizId.' order by sort');
             $basic_infos = DB::select('select * from basic_infos where quiz_id = '.$quizId);
            $colorsAll = DB::select('select * from colors order by sort');
            $quizData = DB::select('select * from quiz where id = '.$quizId);
             for($j=0;$j<count($frames);$j++){
                array_push($selFrame,$frames[$j]->frame_id);
             }
            $data = collectionList();

            $colorsAll = array();
            for($p=0;$p<count($frames);$p++){
                 //$colorsArr = array();
                 //echo $frames[$p]->id;
                 $colors = DB::select('select * from colors where select_frame_id = '.$frames[$p]->id.' order by sort');
                 //print_r($colors);die;
                 for($q=0;$q<count($colors);$q++){
                        array_push($colorsAll, $colors[$q]);
                 }
                 //echo "<PRE>";print_r($colorsArr);die;
                 //array_push($colorsAll, $colorsArr);
            }
          // echo "<PRE>";print_r($colorsAll);die;
          //print_r($colorsAll);die;
        return view ('quiz',['data' => $data,'frames'=>$frames,'selFrame'=>$selFrame,'basic_infos'=>$basic_infos,'colorsAll'=>$colorsAll,'quizId'=>$quizId,'quizData'=>$quizData]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quizId = $_POST['quizId'];
        $frames = DB::select('select * from mirrormates where quiz_id = '.$quizId);
        if(!empty($frames)){
            $sort = count($frames)+1;
        }else{
            $sort = 1;
        }
        
        $mirromate = new mirrormate;
        $fTitle = str_replace('quote','"',$_POST['title']);
        $title = str_replace('#',' ',$fTitle);
        $mirromate->frame = $title;
        $mirromate->frame_id = $_POST['frameid'];
        $mirromate->frame_img = $_POST['frameimg'];
        $mirromate->handle = $_POST['handle'];
        $mirromate->sort = $sort;
        $mirromate->quiz_id = $_POST['quizId'];
        $mirromate->choose = 'You Choose '.$title;
        $mirromate->choose_desc = 'Now, what color frame would you choose for a picture hung in the bath? (Select one)';
        #echo $request->up_id;die;
        $basic_infos =  DB::select('select * from basic_infos where quiz_id = '.$_POST['quizId']);
        if($mirromate->save()){
             $insertedId = $mirromate->id;
            
        }

        $sec = '';
        $secPrev= '';
        $frameid1 = '';
        $s3='s3';
        if($sort == 1){

            $basic_infos = DB::select('select * from basic_infos where quiz_id = '.$_POST['quizId']);
            $AllFrame= DB::select('select * from mirrormates where quiz_id="'.$_POST['quizId'].'" order by sort');
            $sec.= '<div class="step-title"><div onclick=show("'.trim($s3).'",'.$AllFrame[0]->id.')><textarea class="form-control sr-area" name="" id="choose" rows="1" placeholder="You chose Title" onkeyup="change_info('.$basic_infos[0]->id.')">'.$basic_infos[0]->sec_title_1.'</textarea></div>
                </div><div class="step-description"><div onclick=show("'.trim($s3).'",'.$AllFrame[0]->id.')><textarea class="form-control sr-area" name="" id="choose_desc" placeholder="You chose Description" rows="1" onkeyup="change_info('.$basic_infos[0]->id.')">'.$basic_infos[0]->sec_title_2.'</textarea></div></div><hr>';

            $secPrev.='<h1 id="selectedFrame">'.$basic_infos[0]->sec_title_1.'</h1><p id="selectedFramedesc">'.$basic_infos[0]->sec_title_2.'</p>';

            $frameid1.=$AllFrame[0]->id;
        }
       


        $rand = 'abc12';
        $mmId = '';
        $str = '';
        $frameColPrev = '';
            $data = collectionList();
            for($i=0;$i<count($data['response']);$i++) { 
                if($mirromate->frame_id != $data["response"][$i]["id"]){
                    $img = ""; 
                    $title_str = ""; 
                    $title_str = str_replace('"',"quote",$data["response"][$i]["title"]);
                    $title_str = str_replace(' ',"#",$title_str);
                    //$title='"'.$title_str.'"';
                    $handle = $data['response'][$i]['handle'];
                    if(isset($data['response'][$i]['image']['src'])){
                    $img=$data['response'][$i]['image']['src']; 
                    }
                    $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'","'.$rand.'","'.$mmId.'","'.$insertedId.'")>'.$data["response"][$i]["title"].'</a>';
                }
            }
               

        $finalArray = array();
        $allFrame = DB::select('select * from mirrormates where quiz_id = '.$quizId);
        $allFrameC = count($allFrame) + 2;
        $frame = 'You choose '.$title;
         $sampleImg = "background-image: url(".asset("stepimg.jpg").")";
        $colorse = 'color';
        $s3 = 's3';
        $addCol = 'addCol';
        $deleteCol = 'deleteCol';
        $frame_desc = 'Now, what color frame would you choose for a picture hung in the bath? (Select one)';
        $addFrameCol = '';
        $addFrameCol.='<div id="frame_col'.$insertedId.'" onclick=show("'.$s3.'",'.$insertedId.')><div class="steps" id="frameRemove'.$insertedId.'"><div class="steps-box step-shadow"><div id="colormsg'.$insertedId.'" class="colormsg"></div><div class="step--title"><h3>Secondary Step For <span id="stitile'.$insertedId.'">'.$title.'</span></h3></div><div style="margin-top: 52px;"></div><div class="step-no"><div class="step-type"><i class="far fa-image"></i></div></div><div class="step-content"><div class="steprow"><div class="sec" id="sec_'.$insertedId.'"></div><div class="step-choice w-100 mb-30"><div id="" class="new-choice"><div class="sc-row"><div id="main_col'.$rand.$insertedId.'"><div class="sc-choice" id="Col'.$rand.$insertedId.'"><a class="stepsorting" data-scroll="" href="javascript:void(0);"><span class="fup'.$rand.$insertedId.'" onclick=sortUpColor('.$insertedId.','.$rand.');><i class="fas fa-angle-up"></i></span> <span class="fdown'.$rand.$insertedId.'" onclick=sortDownColor('.$insertedId.','.$rand.');><i class="fas fa-angle-down"></i></span></a><span class="stepimg"><div class="imgpreview" id="imgpreviewCol'.$rand.$insertedId.'" style="'.$sampleImg.'"></div></span><span class="stepbullet">- </span><div class="dropdown step-drop"><button onclick=show("'.trim($s3).'",'.$insertedId.'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextCol'.$rand.$insertedId.'">Select</span></button><div class="dropdown-menu drop-name'.$rand.$insertedId.'color" aria-labelledby="dropdownMenuButton"><div class="search-frame"><div class="dd-search"><input id="txtSearchValue_'.$rand.$insertedId.'color" autocomplete="off" onkeyup=filter("'.$rand.'","'.$insertedId.'","'.$colorse.'")  class="dd-searchbox" type="text" placeholder="Search.."></div></div>'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.$addCol.'",'.$insertedId.');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep '.$rand.$insertedId.'" onclick=removeFrame("'.trim($rand).'","'.$deleteCol.'",'.$insertedId.');><i class="fas fa-minus"></i></span></div><br/><input type="hidden" id="cid'.$rand.$insertedId.'"></div><div id="addCol'.$insertedId.'"></div></div></div></div></div></div></div></div></div>';
        
        /*$frameColPrev.='<section id="framep'.$insertedId.'" class="qp-slide qp-color qp-cover framep" style="display: none;"><div class="quiz-box"><div class="quiz-wrapp"><h1 id="selectedFrame'.$insertedId.'">'.$mirromate->choose.'</h1>
          <p id="selectedFramedesc'.$insertedId.'">'.$mirromate->choose_desc.'</p><div class="quizcolor-div"><ul class="quizcolor-row" id="frameulp'.$insertedId.'"><li id="prevCol'.$rand.$insertedId.'"><div class="quizcolor-box">
           <div class="quizcolor-thumb" id="ColImg'.$rand.$insertedId.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <span class="quizcolor-radio"></span><span class="quizcolor-title" id="ColText'.$rand.$insertedId.'">select</span></div></div>
            </li></ul></div></div></div></section>';*/
        $frameColPrev.='<section id="framep'.$insertedId.'" class="qp-slide qp-color qp-cover framep" style="display: none;"><div class="quiz-box"><div class="quiz-wrapp"><div class="sec_prev" id="sec_prev_'.$insertedId.'"></div><div class="quizcolor-div"><ul class="quizcolor-row" id="frameulp'.$insertedId.'"><li id="prevCol'.$rand.$insertedId.'"><div class="quizcolor-box">
           <div class="quizcolor-thumb" id="ColImg'.$rand.$insertedId.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="frames_'.$rand.'"><label class="custom-control-label" id="ColText'.$rand.$insertedId.'" for="frames_'.$rand.'">Select</label></div></div></div></li></ul><div class="steprow"><div class="step-col"><button id="btn6" class="btn btn" style="font-size:'.$basic_infos[0]->next_fsize.'px; background-color:'.$basic_infos[0]->next_btnbgcolor.';  color:'.$basic_infos[0]->next_btn_text_color.'; border-radius:'.$basic_infos[0]->next_bradius.'px">'.$basic_infos[0]->previous_btntext.'</button><button id="btn5" class="btn btn" style="font-size:'.$basic_infos[0]->next_fsize.'px; background-color:'.$basic_infos[0]->next_btnbgcolor.'; color:'.$basic_infos[0]->next_btn_text_color.'; border-radius:'.$basic_infos[0]->next_bradius.'px;">'.$basic_infos[0]->showresult_btntext.'</button></div></div></div></div></div></section>';
           
        $finalArray['addFrameCol'] = $addFrameCol;
        $finalArray['insertedId'] = $insertedId;
        $finalArray['frameColPrev'] = $frameColPrev;
        $finalArray['sec'] = $sec;
        $finalArray['secPrev'] = $secPrev;
        $finalArray['frameid1'] = $frameid1;
        return json_encode($finalArray);exit();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mirromate = new mirrormate;
        $mirromate = Mirrormate::find($id);
         $fTitle = str_replace('quote','"',$_POST['title']);
        $title = str_replace('#',' ',$fTitle);
        $mirromate->frame = $title;
        $mirromate->frame_id = $_POST['frameid'];
        $mirromate->frame_img = $_POST['frameimg'];
        $mirromate->handle = $_POST['handle'];
        $mirromate->choose = 'You Choose '. $title;

        $allColors = DB::select('select * from colors where select_frame_id = '.$id);
        $finalArr = array();
        $allid = array();
        $allchoose1 = array();
         $allchoose2 = array();
        for($i=0;$i<count($allColors);$i++){
            $choose =$choose1=$choose2='';
             $choose = 'You Choose '.$title.' Of '.$allColors[$i]->frame;
             $choose1 = $title.' > '.$allColors[$i]->frame;
             $choose2 = $title.' Of '.$allColors[$i]->frame;
            DB::table('colors')
            ->where(['id'=>$allColors[$i]->id,'select_frame_id'=>$id])
            ->update(['choose' => $choose]);
            array_push($allid,$allColors[$i]->id);
            array_push($allchoose1,$choose1);
             array_push($allchoose2,$choose2);
        }
       // $mirromate->choose_desc = 'Now, what color frame would you choose for a picture hung in the bath? (Select one)';
        #echo $request->up_id;die;
        if($mirromate->save()){
            $data = new MirrormateResources($mirromate);
        }

        $finalArr['data'] =$data;
        $finalArr['allColorId'] =$allid;
        $finalArr['allColorChoose1'] =$allchoose1;
         $finalArr['allColorChoose2'] =$allchoose2;

        echo json_encode($finalArr);exit();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sFrame= DB::select('select * from mirrormates where id="'.$id.'"');
        if(!empty($sFrame)){
            $mirromate = mirrormate::findOrFail($id);
            if($mirromate->delete()) {
                Color::where('select_frame_id',$id)->delete(); 
                frame_col::where('sel_frame_id',$id)->delete(); 
               // return new MirrormateResources($mirromate);
            }
        }
        $s3 = 's3';
        $sec = '';
        $secPrev= '';
        $basic_infos = DB::select('select * from basic_infos where quiz_id = '.$_POST['quizId']);
        $AllFrame= DB::select('select * from mirrormates where quiz_id="'.$_POST['quizId'].'" order by sort');
        $sec.= '<div class="step-title"><div onclick=show("'.trim($s3).'",'.$AllFrame[0]->id.')><textarea class="form-control sr-area" name="" id="choose" rows="1" placeholder="You chose Title" onkeyup="change_info('.$basic_infos[0]->id.')">'.$basic_infos[0]->sec_title_1.'</textarea></div>
            </div><div class="step-description"><div onclick=show("'.trim($s3).'",'.$AllFrame[0]->id.')><textarea class="form-control sr-area" name="" id="choose_desc" placeholder="You chose Description" rows="1" onkeyup="change_info('.$basic_infos[0]->id.')">'.$basic_infos[0]->sec_title_2.'</textarea></div></div><hr>';

        $secPrev.='<h1 id="selectedFrame">'.$basic_infos[0]->sec_title_1.'</h1><p id="selectedFramedesc">'.$basic_infos[0]->sec_title_2.'</p>';

         $data = collectionList();
            $str=$addCol=$framePrev= '';
            $random = rand();
            $mmId = 'abc';
            $s3 = 's3';
            $finalArr = array();
            $framese = 'frame';
            $quizId = $_POST['quizId'];
            $previewFrame = '';
            $deleteCol = "deleteCol";
             $sampleImg = "background-image: url(".asset("stepimg.jpg").")";
            $addFrame = 'addFrame';
                for($i=0;$i<count($data['response']);$i++) { 
                    $img = ""; 
                    $title_str = ""; 
                    $title_str = str_replace('"',"quote",$data["response"][$i]["title"]);
                    $title_str = str_replace(' ',"#",$title_str);
                    //$title='"'.$title_str.'"';
                    $handle = $data['response'][$i]['handle'];
                    if(isset($data['response'][$i]['image']['src'])){
                    $img=$data['response'][$i]['image']['src']; 
                    }
                    $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selFrame("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'",'.$random.',"'.$mmId.'")>'.$data["response"][$i]["title"].'</a>';
                } 
                $frame = '';
                 $selF = DB::select('select * from mirrormates where quiz_id = '.$quizId);
                 if(count($selF) == 0){
                  $frame.='<div id="main'.$random.'"><div class="sc-choice frameSort" id="'.$random.'"><a class="stepsorting" data-scroll="" href="javascript:void(0);"><span class="fup'.$random.'" onclick=sortUpFrame('.$random.');><i class="fas fa-angle-up"></i></span><span class="fdown'.$random.'" onclick="sortDownFrame('.$random.');"><i class="fas fa-angle-down"></i></span></a><span class="stepimg"><div class="imgpreview" id="imgpreview'.$random.'" style="'.$sampleImg.'"></div></span><span class="stepbullet">- </span>';
                  $frame.='<div class="dropdown step-drop"><button  class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntext'.$random.'">Select</span></button><div class="dropdown-menu drop-name'.$random.'frame" aria-labelledby="dropdownMenuButton"><div class="search-frame"><div class="dd-search"><input id="txtSearchValue_'.$random.'frame" autocomplete="off" onkeyup=filter('.$random.',"'.$previewFrame.'","'.$framese.'")  class="dd-searchbox" type="text" placeholder="Search.."></div></div>'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.$addFrame.'");><i class="fas fa-plus"></i></span>
                  <span id="remove" class="choicestep '.$random.'" onclick=removeFrame("'.$random.'","'.$mmId.'");><i class="fas fa-minus"></i></span></div><br/ id="brF'.$random.'"><input type="hidden" id="fid'.$random.'" value=""></div>';

                   /* $framePrev.= '<li id="prevFrame'.$random.'"><div class="quizimg-box"><div class="quizimg-thumb" id="FrameImg'.$random.'" style="'.$sampleImg.'"></div><div class="quizimg-inner"><span class="quizimg-radio"></span>
                  <span class="quizimg-title" id="FrameText'.$random.'">Select</span></div></div></li>';*/
                   $framePrev.= '<li id="prevFrame'.$random.'"><div class="quizimg-box"><div class="quizimg-thumb" id="FrameImg'.$random.'" style="'.$sampleImg.'"></div><div class="quizimg-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="col'.$random.'"><label class="custom-control-label" id="FrameText'.$random.'" for="col'.$random.'">select</label></div></div></div></li>';
                }



         $finalArr = array();
        if($frame != ''){
            $finalArr['frame'] = $frame;
            $finalArr['framePrev'] = $framePrev;
            $finalArr['sec'] = $sec;
            $finalArr['frameId'] = $AllFrame[0]->id;
            $finalArr['secPrev']=$secPrev;
            echo json_encode($finalArr);exit;
        }
        else{
            $finalArr['frame'] = '';
            $finalArr['framePrev'] = '';
            $finalArr['sec'] = $sec;
            $finalArr['frameId'] = $AllFrame[0]->id;
            $finalArr['secPrev']=$secPrev;
            echo json_encode($finalArr);exit;
        }
    }
    public function addFrame(){
            $data = collectionList();
            $str=$addCol= '';
            $random = rand();
            $mmId = 'abc';
            $s3 = 's3';
            $finalArr = array();
            $previewFrame = '';
            $deleteCol = "deleteCol";
            $sampleImg = "background-image: url(".asset("stepimg.jpg").")";
            $quizId = $_POST['quizId'];
            if($_POST['type'] == 'addFrame'){
                $allFID = array();
                $selFrames = DB::select('select * from mirrormates where quiz_id = '.$quizId);
                for($p=0;$p<count($selFrames);$p++){
                    array_push($allFID, $selFrames[$p]->frame_id);
                }
               // print_r($allFID);die;
                for($i=0;$i<count($data['response']);$i++) { 
                    if(!in_array($data["response"][$i]["id"], $allFID)){
                        $img = ""; 
                        $title_str = ""; 
                        $title_str = str_replace('"',"quote",$data["response"][$i]["title"]);
                        $title_str = str_replace(' ',"#",$title_str);
                        //$title='"'.$title_str.'"';
                        $handle = $data['response'][$i]['handle'];
                        if(isset($data['response'][$i]['image']['src'])){
                        $img=$data['response'][$i]['image']['src']; 
                        }
                        $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selFrame("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'",'.$random.',"'.$mmId.'")>'.$data["response"][$i]["title"].'</a>';
                    }
                } 
                $framese = 'frame';
                $addCol.='<div id="main'.$random.'"><div class="sc-choice frameSort" id="'.$random.'"><a class="stepsorting" data-scroll="" href="javascript:void(0);"><span class="fup'.$random.'" onclick=sortUpFrame('.$random.');><i class="fas fa-angle-up"></i></span><span class="fdown'.$random.'" onclick="sortDownFrame('.$random.');"><i class="fas fa-angle-down"></i></span></a><span class="stepimg"><div class="imgpreview" id="imgpreview'.$random.'" style="'.$sampleImg.'"></div></span><span class="stepbullet">- </span>';
                $addCol.='<div class="dropdown step-drop"><button  class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntext'.$random.'">Select</span></button><div class="dropdown-menu drop-name'.$random.'frame" aria-labelledby="dropdownMenuButton"><div class="search-frame"><div class="dd-search"><input id="txtSearchValue_'.$random.'frame" autocomplete="off" onkeyup=filter('.$random.',"'.$previewFrame.'","'.$framese.'")  class="dd-searchbox" type="text" placeholder="Search.."></div></div>'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.trim($_POST['type']).'");><i class="fas fa-plus"></i></span>
                <span id="remove" class="choicestep '.$random.'" onclick=removeFrame("'.$random.'","'.$mmId.'");><i class="fas fa-minus"></i></span></div><br/ id="brF'.$random.'"><input type="hidden" id="fid'.$random.'"></div>';

                 /* $previewFrame.= '<li id="prevFrame'.$random.'"><div class="quizimg-box"><div class="quizimg-thumb" id="FrameImg'.$random.'" style="'.$sampleImg.'"></div><div class="quizimg-inner"><span class="quizimg-radio"></span>
                <span class="quizimg-title" id="FrameText'.$random.'">Select</span></div></div></li>';*/
                $previewFrame.= '<li id="prevFrame'.$random.'"><div class="quizimg-box"><div class="quizimg-thumb" id="FrameImg'.$random.'" style="'.$sampleImg.'"></div><div class="quizimg-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="frames_cols_'.$random.'"><label class="custom-control-label" id="FrameText'.$random.'" for="frames_cols_'.$random.'">Select</label></div></div></div></li>';

            }else if($_POST['type'] == 'addFCol'){
                $s4= 's4';
                $allCID = array();
                /*$selColors = DB::select('select * from colors where select_frame_id = '.$_POST['FId']);
                for($q=0;$q<count($selColors);$q++){
                    array_push($allCID, $selColors[$q]->frame_id);
                }*/
                $selFColAllArr = array();
                $selFColAll = DB::select('select * from frame_cols where sel_color_id='.$_POST['FId']);
                for($r=0;$r<count($selFColAll);$r++){
                   array_push($selFColAllArr, $selFColAll[$r]->frame_id);          
                }
                 $selF = DB::select('select * from colors where id='.$_POST['FId']);
                  for($q=0;$q<count($selF);$q++){
                     $selFCol = DB::select('select * from colors where select_frame_id='.$selF[$q]->select_frame_id);
                     for($n=0;$n<count($selFCol);$n++){
                        array_push($allCID, $selFCol[$n]->frame_id);
                     }
                    
                }
               //echo "<PRE>"; print_r($allCID);die;
                for($i=0;$i<count($data['response']);$i++) {
                     if(!empty($_POST['FId'])){  
                        $selF1 = DB::select('select * from mirrormates where id='.$selF[0]->select_frame_id);
                            if($selF1[0]->frame_id != $data["response"][$i]["id"]){ 
                                if(!in_array($data["response"][$i]["id"], $allCID)){
                                     if(!in_array($data["response"][$i]["id"], $selFColAllArr)){
                                            $img = ""; 
                                            $title_str = ""; 
                                            $title_str = str_replace('"',"quote",$data["response"][$i]["title"]);
                                            $title_str = str_replace(' ',"#",$title_str);
                                            //$title='"'.$title_str.'"';
                                            $handle = $data['response'][$i]['handle'];
                                            if(isset($data['response'][$i]['image']['src'])){
                                            $img=$data['response'][$i]['image']['src']; 
                                            }
                                            $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selFrameColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'",'.$random.',"'.$_POST['FId'].'","'.$selF[0]->select_frame_id.'")>'.$data["response"][$i]["title"].'</a>';
                                        }
                                }
                           }
                    }
                }
               
                $addCol.='<div id="main_frame_col'.$random.$_POST['FId'].'"><div class="sc-choice FcolorSort'.$_POST['FId'].'" id="FCol'.$random.$_POST['FId'].'"> <a class="stepsorting" data-scroll="" href="javascript:void(0);"><span class="fup_col'.$random.$_POST['FId'].'" onclick=sortUpFrameColor('.$random.','.$random.');><i class="fas fa-angle-up"></i></span> <span class="fdown_col'.$random.$_POST['FId'].'" onclick=sortDownFrameColor('.$random.','.$random.');><i class="fas fa-angle-down"></i></span></a><span class="stepimg"><div class="imgpreview" id="imgpreviewFCol'.$random.$_POST['FId'].'" style="'.$sampleImg.'"></div></span><span class="stepbullet">- </span>';
                $addCol.='<div class="dropdown step-drop"><button onclick=show("'.$s4.'",'.$_POST['FId'].'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextFCol'.$random.$_POST['FId'].'">Select</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.$_POST['type'].'",'.$_POST['FId'].');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep '.$random.$_POST['FId'].'" onclick=removeFrame("'.$random.'","'.$deleteCol.'","'.$_POST['FId'].'");><i class="fas fa-minus"></i></span></div><br/ id="brFC'.$random.$_POST['FId'].'"><input type="hidden" id="Fcid'.$random.$_POST['FId'].'" ></div>';

               $previewFrame.='<li id="prevFrameCol'.$random.$_POST['FId'].'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="FrameColImg'.$random.$_POST['FId'].'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span><span class="quizcolor-title" id="FrameColText'.$random.$_POST['FId'].'">Select</span></div></div></li>';
                /*$previewFrame.='<li id="prevFrameCol'.$random.$_POST['FId'].'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="FrameColImg'.$random.$_POST['FId'].'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="frames_cols'.$random.'"><label class="custom-control-label" id="FrameColText'.$random.$_POST['FId'].'" for="frames_cols'.$random.'">select</label></div></div></div></li>';*/
            }
            else{
                 $allCID = array();
                $selColors = DB::select('select * from colors where select_frame_id = '.$_POST['FId']);
                for($q=0;$q<count($selColors);$q++){
                    array_push($allCID, $selColors[$q]->frame_id);
                }
                for($i=0;$i<count($data['response']);$i++) {
                     if(!empty($_POST['FId'])){  
                        $selF = DB::select('select * from mirrormates where id='.$_POST['FId']);
                            if($selF[0]->frame_id != $data["response"][$i]["id"]){ 
                                if(!in_array($data["response"][$i]["id"], $allCID)){
                                    $img = ""; 
                                    $title_str = ""; 
                                    $title_str = str_replace('"',"quote",$data["response"][$i]["title"]);
                                    $title_str = str_replace(' ',"#",$title_str);
                                    //$title='"'.$title_str.'"';
                                    $handle = $data['response'][$i]['handle'];
                                    if(isset($data['response'][$i]['image']['src'])){
                                    $img=$data['response'][$i]['image']['src']; 
                                    }
                                    $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'",'.$random.',"'.$mmId.'","'.$_POST['FId'].'")>'.$data["response"][$i]["title"].'</a>';
                                }
                            }
                    }
                }
                $colorse = 'color'; 
                $addCol.='<div id="main_col'.$random.$_POST['FId'].'"><div class="sc-choice colorSort'.$random.'" id="Col'.$random.$_POST['FId'].'"> <a class="stepsorting" data-scroll="" href="javascript:void(0);"><span class="fup'.$random.$_POST['FId'].'" onclick=sortUpColor('.$random.','.$random.');><i class="fas fa-angle-up"></i></span> <span class="fdown'.$random.$_POST['FId'].'" onclick=sortDownColor('.$random.','.$random.');><i class="fas fa-angle-down"></i></span></a><span class="stepimg"><div class="imgpreview" id="imgpreviewCol'.$random.$_POST['FId'].'" style="'.$sampleImg.'"></div></span><span class="stepbullet">- </span>';
                $addCol.='<div class="dropdown step-drop"><button onclick=show("'.$s3.'",'.$_POST['FId'].'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextCol'.$random.$_POST['FId'].'">Select</span></button><div class="dropdown-menu drop-name'.$random.$_POST['FId'].'color" aria-labelledby="dropdownMenuButton"><div class="search-frame"><div class="dd-search"><input id="txtSearchValue_'.$random.$_POST['FId'].'color" autocomplete="off" onkeyup=filter("'.$random.'","'.$_POST['FId'].'","'.$colorse.'")  class="dd-searchbox" type="text" placeholder="Search.."></div></div>'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.$_POST['type'].'",'.$_POST['FId'].');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep '.$random.$_POST['FId'].'" onclick=removeFrame("'.$random.'","'.$deleteCol.'","'.$_POST['FId'].'");><i class="fas fa-minus"></i></span></div><br/ id="brC'.$random.$_POST['FId'].'"><input type="hidden" id="cid'.$random.$_POST['FId'].'" ></div>';

                /*$previewFrame.='<li id="prevCol'.$random.$_POST['FId'].'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$random.$_POST['FId'].'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span><span class="quizcolor-title" id="ColText'.$random.$_POST['FId'].'">Select</span></div></div></li>';*/
                $previewFrame.='<li id="prevCol'.$random.$_POST['FId'].'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$random.$_POST['FId'].'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="framescols_'.$random.'"><label class="custom-control-label" id="ColText'.$random.$_POST['FId'].'" for="framescols_'.$random.'">Select</label></div></div></div></li>';
            }


          
           /* $frames = DB::select('select * from mirrormates');
            $count = count($frames)+1;*/
          
            $finalArr['addCol'] = $addCol;
            $finalArr['previewFrame'] = $previewFrame;
            if($_POST['FId'] != ''){
              $finalArr['frameid'] = $_POST['FId'];
            }
             return json_encode($finalArr);exit;
    }

    public function check_frame(){
        $quizId = $_POST['quizId'];
        $mirrormate = DB::select('select * from mirrormates where frame_id  = '.$_POST['frameid'].' and quiz_id = '.$quizId);
        if(!empty($mirrormate)){
            $fname = $mirrormate[0]->frame;
        }else{
            $fname = '';
        }

        return json_encode($fname);exit;
    }

    public function change_info($id){
        $basicInfo = new basicInfo;
        $basicInfo = basicInfo::find($id);
        $basicInfo->sec_title_1 = $_POST['choose'];
        $basicInfo->sec_title_2 = $_POST['choose_desc'];
       
        #echo $request->up_id;die;
        if($basicInfo->save()){
            return new BasicInfoResources($basicInfo);
        }
    }

    public function sortingFrame(){
      echo "<PRE>";print_r($_POST);
      if(!empty($_POST)){
        $sortCount = 1;
         if(!empty($_POST['arr'])){
            for ($i=0; $i <= count($_POST['arr'])-1 ; $i++) { 
                    $affected = DB::table('mirrormates')
                    ->where('id',$_POST['arr'][$i])
                    ->update(['sort' => $sortCount]);
                    echo $sortCount;
                    $sortCount++;
                 }
            }   
         }
    }

    public function framePrev(){
        $frameP = '';
         $quizId = $_POST['quizId'];
        $frames = DB::select('select * from mirrormates where quiz_id = '.$quizId.' order by sort');

        $frameP.='<ul class="quizimg-row" id="selF">';
         if(!empty($frames)) { 
            for($i=0;$i<count($frames);$i++) { 
                /*$frameP.='<li id="prevFrame'.$frames[$i]->id.'" onclick=colors('.$frames[$i]->id.');><div class="quizimg-box"><div class="quizimg-thumb" id="FrameImg'.$i.'" style="background-image: url('.$frames[$i]->frame_img.');"></div><div class="quizimg-inner"><span class="quizimg-radio"></span><span class="quizimg-title" id="FrameText'.$i.'">'.$frames[$i]->frame.'</span></div></div></li>';*/
                $frameP.='<li id="prevFrame'.$frames[$i]->id.'" onclick=colors('.$frames[$i]->id.');><div class="quizimg-box"><div class="quizimg-thumb" id="FrameImg'.$i.'" style="background-image: url('.$frames[$i]->frame_img.');"></div><div class="quizimg-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="frames_cols'.$i.'"><label class="custom-control-label" id="FrameText'.$i.'" for="frames_cols'.$i.'">'.$frames[$i]->frame.'</label></div></div></div></li>';
            }
          }
        $frameP.='</ul>'; 
        //echo $frameP;die;
        echo json_encode($frameP);exit();  
    }
}
