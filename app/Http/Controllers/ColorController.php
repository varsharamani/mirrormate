<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Color;
use App\frame_col;
use Session;
use DB;


use App\Http\Resources\color as ColorResources;

class ColorController extends Controller
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

    public function index()
    {
       
            $selFrame = array();
            $selFrame_color = array();
            //$quizId = Session::get('quizId');
             $frames = DB::select('select * from mirrormates where quiz_id = '.$quizId);
             for($j=0;$j<count($frames);$j++){
                array_push($selFrame,$frames[$j]->frame_id);
                $sel_color = DB::select('select * from colors where select_frame_id='.$frames[$j]->id);
                foreach($sel_color as $value){
                   // $selFrame_color[] = $value->id;
                    $selFrame_color[$frames[$j]->id][] = $value->frame;

                }
                
                //array_push($selFrame_color,$sel_color[$j]->id);
             }
            $responseData = collectionList();
            
                 Session::put('total',count($frames));
               
            $colors = DB::select('select * from colors');
           // echo "<PRE>";print_r($selFrame_color);exit();
        return view ('quiz',['data' => $responseData,'frames'=>$frames,'selFrame'=>$selFrame,'colors'=>$colors,'selFrame_color'=>$selFrame_color]);
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
        $finalArr = array();
        $colors = DB::select('select * from colors where select_frame_id='.$_POST['select_frame_id']);
        if(!empty($colors)){
            $sort = count($colors)+1;
        }else{
            $sort = 1;
        }

        $color = new Color;
        $fTitle = str_replace('quote','"',$_POST['title']);
        $title = str_replace('#',' ',$fTitle);
        $color->frame = $title;
        $color->select_frame_id = $_POST['select_frame_id'];
        $color->frame_img = $_POST['frameimg'];
        $color->frame_id = $_POST['frameid'];
        $color->handle = $_POST['handle'];
        $color->sort = $sort;
        //echo $_POST['select_frame_id'];
        $frames = DB::select('select * from mirrormates where id ='.$_POST['select_frame_id']);
       // print_r($frames);die;
        $color->choose = 'You Choose '.$frames[0]->frame.' Of '.$title;
        $color->choose_desc = 'Now, what color frame would you choose for a picture hung in the bath? (Select one)';
        //echo $request->input('frame_img');die;
        if($color->save()){
            $data1 =  new ColorResources($color);
        }

        $sectitile = $frames[0]->frame.' > '.$title;
        $rand = 'xyz12';
        $mmId = '';
        $str = '';
         $insertedId = $color->id;
        $frameColPrev = '';
        $allCID = array();
         $selFColAllArr = array();
                $selFColAll = DB::select('select * from frame_cols where sel_color_id='.$insertedId);
                for($r=0;$r<count($selFColAll);$r++){
                   array_push($selFColAllArr, $selFColAll[$r]->frame_id);          
                }
                 $selF = DB::select('select * from colors where id='.$insertedId);
                  for($q=0;$q<count($selF);$q++){
                     $selFCol = DB::select('select * from colors where select_frame_id='.$selF[$q]->select_frame_id);
                     //echo "<PRE>";print_r($selFCol);die;
                     for($n=0;$n<count($selFCol);$n++){
                        array_push($allCID, $selFCol[$n]->frame_id);
                     }
                    
                }
            $data = collectionList();
            for($i=0;$i<count($data['response']);$i++) {
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
                            $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selFrameColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'","'.$rand.'","'.$insertedId.'","'.$_POST['select_frame_id'].'")>'.$data["response"][$i]["title"].'</a>';
                        }
                    }
                }
             }
               

        $finalArray = array();
         $quizId = $_POST['quizId'];
        $allFrame = DB::select('select * from mirrormates where quiz_id = '.$quizId);
       $sampleImg = "background-image: url(".asset("stepimg.jpg").")";
        $s4 = 's4';
        $addCol = 'addFCol';
        $deleteCol = 'deleteFCol';
        $frame_desc = 'Now, what color frame would you choose for a picture hung in the bath? (Select one)';
        $addFrameCol = '';
        $addFrameCol.='<div class="fcolor'.$_POST['select_frame_id'].'" id="frame_col_com'.$_POST['select_frame_id'].$insertedId.'" onclick=show("'.$s4.'",'.$insertedId.')><div class="steps" id="frameRemove'.$insertedId.'"><div class="steps-box step-shadow"> <div id="Fcolormsg'.$insertedId.'" class="Fcolormsg"></div><div class="step--title"><h3>Secondary Step For <span id="stitle'.$insertedId.'">'.$sectitile.'</span></h3></div><div class="step-no"><div class="step-type"><i class="far fa-image"></i></div></div><div class="step-content"><div class="steprow"><div class="step-title"><a onclick=show("'.trim($s4).'",'.$insertedId.');><textarea onkeyup=change_info_Fcolor('.$insertedId.'); class="form-control sr-area" name="" id="choose_Fcolor'.$insertedId.'" rows="1" >'.$color->choose.'</textarea></a></div><div class="step-description"><a onclick=show("'.trim($s4).'",'.$insertedId.');><textarea class="form-control sr-area" name="" onkeyup=change_info_Fcolor('.$insertedId.'); id="choose_desc_Fcolor'.$insertedId.'" rows="1">'.$color->choose_desc.'</textarea></a></div><div class="step-choice w-100 mb-30"><div id="" class="new-choice"><div class="sc-row"><hr><div id="main_frame_col'.$rand.$insertedId.'"><div class="sc-choice FcolorSort'.$insertedId.'" id="FCol'.$rand.$insertedId.'"><a class="stepsorting" data-scroll="" href="javascript:void(0);"><span class="fup_col'.$rand.$insertedId.'" onclick=sortUpFrameColor('.$insertedId.','.$rand.');><i class="fas fa-angle-up"></i></span> <span class="fdown_col'.$rand.$insertedId.'" onclick=sortDownFrameColor('.$insertedId.','.$rand.');><i class="fas fa-angle-down"></i></span></a><span class="stepimg"><div class="imgpreview" id="imgpreviewFCol'.$rand.$insertedId.'" style="'.$sampleImg.'"></div></span><span class="stepbullet">- </span><div class="dropdown step-drop"><button onclick=show("'.trim($s4).'",'.$insertedId.'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextFCol'.$rand.$insertedId.'">Select</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.$addCol.'",'.$insertedId.');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep '.$rand.$insertedId.'" onclick=removeFrame("'.trim($rand).'","'.$deleteCol.'",'.$insertedId.');><i class="fas fa-minus"></i></span></div><br/ id="brFC'.$rand.$insertedId.'"><input type="hidden" id="Fcid'.$rand.$insertedId.'"></div><div id="addFCol'.$insertedId.'"></div></div></div></div></div></div></div></div></div>';
        
        $frameColPrev.='<section id="frameColp'.$insertedId.'" class="qp-slide qp-color qp-cover frameColp" style="display: none;"><div class="quiz-box"><div class="quiz-wrapp"><h1 id="selectedFrameCol'.$insertedId.'">'.$color->choose.'</h1>
          <p id="selectedFramedescCol'.$insertedId.'">'.$color->choose_desc.'</p><div class="quizcolor-div"><ul class="quizcolor-row" id="framecolulp'.$insertedId.'"><li id="prevFrameCol'.$rand.$insertedId.'"><div class="quizcolor-box">
           <div class="quizcolor-thumb" id="FrameColImg'.$rand.$insertedId.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <span class="quizcolor-radio"></span><span class="quizcolor-title" id="FrameColText'.$rand.$insertedId.'">Select</span></div></div>
            </li></ul></div></div></div></section>';

        /*$frameColPrev.='<section id="frameColp'.$insertedId.'" class="qp-slide qp-color qp-cover frameColp" style="display: none;"><div class="quiz-box"><div class="quiz-wrapp"><h1 id="selectedFrameCol'.$insertedId.'">'.$color->choose.'</h1>
          <p id="selectedFramedescCol'.$insertedId.'">'.$color->choose_desc.'</p><div class="quizcolor-div"><ul class="quizcolor-row" id="framecolulp'.$insertedId.'"><li id="prevFrameCol'.$rand.$insertedId.'"><div class="quizcolor-box">
           <div class="quizcolor-thumb" id="FrameColImg'.$rand.$insertedId.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" name="checkbox" id="abc'.$rand.'"><label class="custom-control-label" id="FrameColText'.$rand.$insertedId.'" for="abc'.$rand.'">select</label></div></div></div></li></ul></div></div></div></section>';*/
        $finalArr['data'] = $data1;
        $finalArr['addFrameCol'] = $addFrameCol;
        $finalArr['frameColPrev'] = $frameColPrev;
        echo json_encode($finalArr);exit();
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
         $color = new Color;
        $fTitle = str_replace('quote','"',$_POST['title']);
        $title = str_replace('#',' ',$fTitle);
        $color = Color::find($id);
        $color->frame = $title;
        $color->select_frame_id = $_POST['select_frame_id'];
        $color->frame_img = $_POST['frameimg'];
        $color->frame_id = $_POST['frameid'];
        $color->handle = $_POST['handle'];
         $frames = DB::select('select * from mirrormates where id ='.$color->select_frame_id);
         $color->choose = 'You Choose '.$frames[0]->frame.' Of '.$title;
         $Fchoose = $frames[0]->frame.' > '.$title;
        //$mirromate->choose = 'You Choose '. $title;
        //echo $request->input('frame_img');die;
         $finalArr = array();
        if($color->save()){
            $data =  new ColorResources($color);
        }

        $finalArr['data'] = $data;
        $finalArr['Fchoose'] = $Fchoose;
        echo json_encode($finalArr);exit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$frameid)
    {

        $selColors = DB::select('select * from colors where id="'.$id.'"');
        if(!empty($selColors)){
             $color = Color::findOrFail($id);
         if($color->delete()) {
             new ColorResources($color);
             frame_col::where('sel_color_id',$id)->delete(); 
            }
        }
       

       
            $data = collectionList();
            $str = "";
            $Col = '';
            $rand = 'abc123';
            $s3 = 's3';
            $addCol = 'addCol';
            $deleteCol = 'deleteCol';
            $mmId = 'abc';
            for($i=0;$i<count($data['response']);$i++) {
                if(!empty($frameid)){  
                    $selF = DB::select('select * from mirrormates where id='.$frameid);
                    if($selF[0]->frame_id != $data["response"][$i]["id"]){  
                        $img = ""; 
                        $title_str = ""; 
                        $title_str = str_replace('"',"quote",$data["response"][$i]["title"]);
                        $title_str = str_replace(' ',"#",$title_str);
                        //$title='"'.$title_str.'"';
                        $handle = $data['response'][$i]['handle'];
                        if(isset($data['response'][$i]['image']['src'])){
                        $img=$data['response'][$i]['image']['src']; 
                        }
                        $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'","'.$rand.'","'.$mmId.'","'.$frameid.'")>'.$data["response"][$i]["title"].'</a>';
                    }
                }
            }
        $sampleImg = "background-image: url(".asset("stepimg.jpg").")";
        $ColPrev = '';
        if(!empty($frameid)){

             $selC = DB::select('select * from colors where select_frame_id  = '.$frameid);
             //echo $selC;die;
             // echo "<PRE>";  print_r($selC);die;
             $colorse = 'color';
             if(count($selC) == 0){ 
                    $Col.=' <div id="main_col'.$rand.$frameid.'"><div class="sc-choice" id="Col'.$rand.$frameid.'"><a class="stepsorting" data-scroll="" href="javascript:void(0);"><span class="fup'.$rand.$frameid.'" onclick=sortUpColor('.$Col.','.$frameid.');><i class="fas fa-angle-up"></i></span><span class="fdown'.$rand.$frameid.'" onclick="sortDownColor('.$Col.','.$frameid.');"><i class="fas fa-angle-down"></i></span></a><span class="stepimg">
                          <div class="imgpreview" id="imgpreviewCol'.$rand.$frameid.'" style="'.$sampleImg.'"></div></span>
                           <span class="stepbullet">- </span><div class="dropdown step-drop"><button onclick=show("'.$s3.'",'.$frameid.'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextCol'.$rand.$frameid.'">Select</span></button><div class="dropdown-menu drop-name'.$rand.$frameid.'color" aria-labelledby="dropdownMenuButton"><div class="search-frame"><div class="dd-search"><input id="txtSearchValue_'.$rand.$frameid.'color" autocomplete="off" onkeyup=filter("'.$rand.'","'.$frameid.'","'.$colorse.'")  class="dd-searchbox" type="text" placeholder="Search.."></div></div>'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.$addCol.'",'.$frameid.');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep '.$rand.$frameid.'" onclick=removeFrame("'.trim($rand).'","'.$deleteCol.'",'.$frameid.');><i class="fas fa-minus"></i></span></div><br/ id="brC'.$rand.$frameid.'"><input type="hidden" id="cid'.$rand.$frameid.'" ></div>'; 
                    /*$ColPrev.='<li id="prevCol'.$rand.$frameid.'"><div class="quizcolor-box">
                                <div class="quizcolor-thumb" id="ColImg'.$rand.$frameid.'" style="'.$sampleImg.'"></div> <div class="quizcolor-inner">
                                <span class="quizcolor-radio"></span><span class="quizcolor-title" id="ColText'.$rand.$frameid.'">select</span></div></div></li>';*/
                                $ColPrev.='<li id="prevCol'.$rand.$frameid.'"><div class="quizcolor-box">
                                <div class="quizcolor-thumb" id="ColImg'.$rand.$frameid.'" style="'.$sampleImg.'"></div> <div class="quizcolor-inner">
                                  <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="cols'.$rand.'"><label class="custom-control-label"id="ColText'.$rand.$frameid.'" for="cols'.$rand.'">Select</label></div></div></div></li>';
             }
        }
         $finalArr = array();
        if($Col != ''){
            $finalArr['Col'] = $Col;
            $finalArr['ColPrev'] = $ColPrev;
            echo json_encode($finalArr);exit;
        }
        else{
            $finalArr['Col'] = '';
            $finalArr['ColPrev'] = '';
            echo json_encode($finalArr);exit;
        }
       
    }

    public function selectData(){
         $selCol = DB::select('select * from colors where select_frame_id  = '.$_POST['frameid'].' order by sort');
         $mirrormate = DB::select('select * from mirrormates where id  = '.$_POST['frameid']);
         //print_r($selCol);die;
         $sampleImg = "background-image: url(".asset("stepimg.jpg").")";
         $addSelCol = '';
         $finalArray = array();
         $random = 'abc12';
         if(!empty($selCol)){
         for($i=0;$i<count($selCol);$i++){
                /*$addSelCol.='<li id="prevCol'.$selCol[$i]->id.'" onclick=redirectColor("'.$selCol[$i]->handle.'");><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$i.$mirrormate[0]->id.'" style="background-image: url('.$selCol[$i]->frame_img.');"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span>
                    <span class="quizcolor-title" id="ColText'.$i.$mirrormate[0]->id.'">'.$selCol[$i]->frame.'</span></div></div></li>';*/
                    $addSelCol.='<li id="prevCol'.$selCol[$i]->id.'" onclick=redirectColor("'.$selCol[$i]->handle.'");><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$i.$mirrormate[0]->id.'" style="background-image: url('.$selCol[$i]->frame_img.');"></div><div class="quizcolor-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="cols_'.$selCol[$i]->id.'"><label class="custom-control-label" id="ColText'.$i.$mirrormate[0]->id.'" for="cols_'.$selCol[$i]->id.'">'.$selCol[$i]->frame.'</label></div></div></div></li>';

        }

        }else{
            /*$addSelCol.= '<li id="prevCol'.$random.'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$random.$mirrormate[0]->id.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span><span class="quizcolor-title" id="ColText'.$random.$mirrormate[0]->id.'">Select</span></div></div></li>';*/
            $addSelCol.= '<li id="prevCol'.$random.'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$random.$mirrormate[0]->id.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <div class="custom-control custom-checkbox mr-sm-2">
                <input class="custom-control-input" type="checkbox" value="" name="checkbox" id="col_'.$random.'"><label class="custom-control-label" id="ColText'.$random.$mirrormate[0]->id.'" for="col_'.$random.'">select</label> </div></div></div></li>';
        }
        //array_merge($mirrormates,$addSelCol);
        //echo "<PRE>";print_r($mirrormates);die;
        $finalArray['addSelCol'] = $addSelCol;
        $finalArray['data'] = $mirrormate;
        return json_encode($finalArray);exit;
    }

     public function change_info_col($id){
        $color = new Color;
        $color = Color::find($id);
        $color->choose = $_POST['choose'];
        $color->choose_desc = $_POST['choose_desc'];
       
        #echo $request->up_id;die;
        if($color->save()){
            return new ColorResources($color);
        }
    }

    public function check_Color(){
         $colorsData = DB::select('select * from colors where frame_id = '.$_POST['frameid'].' and select_frame_id ='.$_POST['select_frame_id'] );
        if(!empty($colorsData)){
            $fname = $colorsData[0]->frame;
        }else{
            $fname = '';
        }

        return json_encode($fname);exit;
    }

    public function sortingColor(){
     //echo "<PRE>";print_r($_POST);
      if(!empty($_POST)){
        $sortCount = 1;
         if(!empty($_POST['arr'])){
            for ($i=0; $i <= count($_POST['arr'])-1 ; $i++) { 
                    $affected = DB::table('colors')
                    ->where(['id'=>$_POST['arr'][$i],'select_frame_id'=>$_POST['frameid']])
                    ->update(['sort' => $sortCount]);
                    echo $sortCount;
                    $sortCount++;
                 }
            }   
         }
    }
}
