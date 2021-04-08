<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\frame_col;
use DB;
use App\Http\Resources\frame_col as frame_colResources;
use Session;

class Frame_colController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $frame_col = DB::select('select * from frame_cols where sel_frame_id = '.$_POST['sel_frame_id'].' and sel_color_id = '.$_POST['sel_color_id']);
        if(!empty($frame_col)){
            $sort = count($frame_col)+1;
        }else{
            $sort = 1;
        }
        
        $frame_color = new frame_col;
        $fTitle = str_replace('quote','"',$_POST['frame']);
        $title = str_replace('#',' ',$fTitle);
        $frame_color->sel_frame_id = $_POST['sel_frame_id'];
        $frame_color->sel_color_id = $_POST['sel_color_id'];
        $frame_color->frame = $title;
        $frame_color->frame_id = $_POST['frame_id'];
        $frame_color->frame_img = $_POST['frame_img'];
        $frame_color->handle = $_POST['handle'];
        $frame_color->sort = $sort;
        #echo $request->up_id;die;

        if($frame_color->save()){
            return new frame_colResources($frame_color);
            
        }

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
        $frame_color = new frame_col;
        $fTitle = str_replace('quote','"',$_POST['frame']);
        $title = str_replace('#',' ',$fTitle);
         $frame_color = frame_col::find($id);
        $frame_color->sel_frame_id = $_POST['sel_frame_id'];
        $frame_color->sel_color_id = $_POST['sel_color_id'];
        $frame_color->frame = $title;
        $frame_color->frame_id = $_POST['frame_id'];
        $frame_color->frame_img = $_POST['frame_img'];
        $frame_color->handle = $_POST['handle'];
       
        #echo $request->up_id;die;

        if($frame_color->save()){
            return new frame_colResources($frame_color);      
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$colorid)
    {
           // echo $id;die;

        $selFColors = DB::select('select * from frame_cols where id="'.$id.'"');
        if(!empty($selFColors)){
             $frame_col = frame_col::findOrFail($id);
         if($frame_col->delete()) {
              new frame_colResources($frame_col);
            }
        }
        $sampleImg = "background-image: url(".asset("stepimg.jpg").")";
        $s4= 's4';
                $allCID = array();
               /* $selColors = DB::select('select * from colors where select_frame_id = '.$_POST['FId']);
                for($q=0;$q<count($selColors);$q++){
                    array_push($allCID, $selColors[$q]->frame_id);
                }*/
                $str = '';
                 $data = collectionList();
                $random = rand();
                $deleteCol = 'deleteFCol';
                 $addCol = 'addFCol';
                 $selF = DB::select('select * from colors where id='.$colorid);
                for($i=0;$i<count($data['response']);$i++) {
                    // if(!empty($_POST['FId'])){  
                        $selF = DB::select('select * from colors where id='.$colorid);
                            //if($selF[0]->frame_id != $data["response"][$i]["id"]){ 
                              //  if(!in_array($data["response"][$i]["id"], $allCID)){
                                    $img = ""; 
                                    $title_str = ""; 
                                    $title_str = str_replace('"',"quote",$data["response"][$i]["title"]);
                                    $title_str = str_replace(' ',"#",$title_str);
                                    //$title='"'.$title_str.'"';
                                    $handle = $data['response'][$i]['handle'];
                                    if(isset($data['response'][$i]['image']['src'])){
                                    $img=$data['response'][$i]['image']['src']; 
                                    }
                                    $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selFrameColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'",'.$random.',"'.$colorid.'","'.$selF[0]->select_frame_id.'")>'.$data["response"][$i]["title"].'</a>';
                               // }
                          //  }
                  //  }
                }
            $ColPrev1 = '';  
            $Col1 = ''; 
            if(!empty($colorid)){
                $addFCol = 'addFCol';
                $deleteCol = 'deleteFCol';
             $selC = DB::select('select * from frame_cols where sel_color_id  = '.$colorid);
            // echo count($selC);
             if(count($selC) == 0){ 

                 $Col1.='<div id="main_frame_col'.$random.$colorid.'"><div class="sc-choice FcolorSort'.$colorid.'" id="FCol'.$random.$colorid.'"> <a class="stepsorting" data-scroll="" href="javascript:void(0);"><span class="fup_col'.$random.$colorid.'" onclick=sortUpFrameColor('.$random.','.$random.');><i class="fas fa-angle-up"></i></span> <span class="fdown_col'.$random.$colorid.'" onclick=sortDownFrameColor('.$random.','.$random.');><i class="fas fa-angle-down"></i></span></a><span class="stepimg"><div class="imgpreview" id="imgpreviewFCol'.$random.$colorid.'" style="'.$sampleImg.'"></div></span><span class="stepbullet">- </span>';
                $Col1.='<div class="dropdown step-drop"><button onclick=show("'.$s4.'",'.$colorid.'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextFCol'.$random.$colorid.'">Select</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.$addFCol.'",'.$colorid.');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep '.$random.$colorid.'" onclick=removeFrame("'.$random.'","'.$deleteCol.'","'.$colorid.'");><i class="fas fa-minus"></i></span></div><br/ id="brFC'.$random.$colorid.'"><input type="hidden" id="Fcid'.$random.$colorid.'" ></div>';

                $ColPrev1.='<li id="prevFrameCol'.$random.$colorid.'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="FrameColImg'.$random.$colorid.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span><span class="quizcolor-title" id="FrameColText'.$random.$colorid.'">Select</span></div></div></li>';
               /* $ColPrev1.='<li id="prevFrameCol'.$random.$colorid.'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="FrameColImg'.$random.$colorid.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="cls_'.$random.'"><label class="custom-control-label" id="FrameColText'.$random.$colorid.'" for="cls_'.$random.'; ?>">select</label></div></div></div></li>';*/
            }
        }
                $finalArr = array();
        if($Col1 != ''){
            $finalArr['Col'] = $Col1;
            $finalArr['ColPrev'] = $ColPrev1;
            echo json_encode($finalArr);exit;
        }
        else{
            $finalArr['Col'] = '';
            $finalArr['ColPrev'] = '';
            echo json_encode($finalArr);exit;
        }
    }

     public function sortingFrameColor(){
     echo "<PRE>";print_r($_POST);
      if(!empty($_POST)){
        $sortCount = 1;
         if(!empty($_POST['arr'])){
            for ($i=0; $i <= count($_POST['arr'])-1 ; $i++) { 
                    $affected = DB::table('frame_cols')
                    ->where(['id'=>$_POST['arr'][$i],'sel_frame_id'=>$_POST['frameid'],'sel_color_id'=>$_POST['colorid']])
                    ->update(['sort' => $sortCount]);
                    echo $sortCount;
                    $sortCount++;
                 }
            }   
         }
    }

    public function check_FColor(){
        $FcolorsData = DB::select('select * from frame_cols where frame_id = '.$_POST['frameid'].' and sel_frame_id ='.$_POST['select_frame_id'] );
        if(!empty($FcolorsData)){
            $fname = $FcolorsData[0]->frame;
        }else{
            $fname = '';
        }

        return json_encode($fname);exit;
    }
    public function selectedFrameCol(){
         $selCol = DB::select('select * from frame_cols where sel_frame_id  = '.$_POST['frameid'].' and sel_color_id = '.$_POST['colorid'].' order by sort');
         $mirrormate = DB::select('select * from colors where id  = '.$_POST['colorid']);
         $sampleImg = "background-image: url(".asset("stepimg.jpg").")";
         $addSelCol = '';
         $finalArray = array();
         $random = 'xyz12';
         if(!empty($selCol)){
         for($i=0;$i<count($selCol);$i++){
                $addSelCol.='<li id="prevFrameCol'.$selCol[$i]->id.'" onclick=redirectColor("'.$selCol[$i]->handle.'");><div class="quizcolor-box"><div class="quizcolor-thumb" id="FrameColImg'.$i.$mirrormate[0]->id.'" style="background-image: url('.$selCol[$i]->frame_img.');"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span>
                    <span class="quizcolor-title" id="FrameColText'.$i.$mirrormate[0]->id.'">'.$selCol[$i]->frame.'</span></div></div></li>';
                    /*$addSelCol.='<li id="prevFrameCol'.$selCol[$i]->id.'" onclick=redirectColor("'.$selCol[$i]->handle.'");><div class="quizcolor-box"><div class="quizcolor-thumb" id="FrameColImg'.$i.$mirrormate[0]->id.'" style="background-image: url('.$selCol[$i]->frame_img.');"></div><div class="quizcolor-inner">  <div class="custom-control custom-checkbox mr-sm-2"><input class="custom-control-input" type="checkbox" value="" name="checkbox" id="ols_'.$selCol[$i]->id.'; ?>"><label class="custom-control-label" id="FrameColText'.$i.$mirrormate[0]->id.'" for="ols_'.$$selCol[$i]->id.'">'.$selCol[$i]->frame.'</label></div></div></div></li>';*/

         }

        }else{
            $addSelCol.= '<li id="prevCol'.$random.'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="FrameColImg'.$random.$mirrormate[0]->id.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span><span class="quizcolor-title" id="FrameColText'.$random.$mirrormate[0]->id.'">Select</span></div></div></li>';
            /*$addSelCol.= '<li id="prevCol'.$random.'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="FrameColImg'.$random.$mirrormate[0]->id.'" style="'.$sampleImg.'"></div><div class="quizcolor-inner"> <div class="custom-control custom-checkbox mr-sm-2"> <input class="custom-control-input" type="checkbox" value="" name="checkbox" id="cos_'.$random.'"><label class="custom-control-label" id="FrameColText'.$random.$mirrormate[0]->id.'" for="cos_'.$random.'">select</label></div></div></div></li>';*/
        }
        //array_merge($mirrormates,$addSelCol);
        //echo "<PRE>";print_r($mirrormates);die;
        $finalArray['addSelCol'] = $addSelCol;
        $finalArray['data'] = $mirrormate;
        return json_encode($finalArray);exit;
    }
}
