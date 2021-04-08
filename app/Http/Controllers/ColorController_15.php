<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Color;
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
        /* $mirrormate = Mirrormate::all();
        #print_r($mirrormate);die;
        //return collection
        
        #print_r($data);die;
        return MirrormateResources::collection($mirrormate);
        //return new MirrormateResources($data);*/
        $baseUrl = 'https://mirrormatellc.myshopify.com/admin/';
        $url = $baseUrl.'custom_collections.json';
       // echo $url;die;
    
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);  
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: POST') );
            //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);
            curl_close($ch);
            $responseData = array();
            $responseArr = json_decode($response);
            foreach ($responseArr as $key => $value) {
                foreach ($value as $k => $val) {
                    $responseData['id'][$k]=$val->id;
                    $responseData['response'][$k]=$val;
                }
            }
            $selFrame = array();
            $selFrame_color = array();
            //$selFrame_color = array();

             $frames = DB::select('select * from mirrormates');
             for($j=0;$j<count($frames);$j++){
                array_push($selFrame,$frames[$j]->frame_id);
                $sel_color = DB::select('select * from colors where select_frame_id='.$frames[$j]->id);
                foreach($sel_color as $value){
                   // $selFrame_color[] = $value->id;
                    $selFrame_color[$frames[$j]->id][] = $value->frame;

                }
                
                //array_push($selFrame_color,$sel_color[$j]->id);
             }
            $responseData = json_decode(json_encode($responseData), true);
            
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
        $color = new Color;
        $fTitle = str_replace('quote','"',$_POST['title']);
        $title = str_replace('#',' ',$fTitle);
        $color->frame = $title;
        $color->select_frame_id = $_POST['select_frame_id'];
        $color->frame_img = $_POST['frameimg'];
        $color->frame_id = $_POST['frameid'];
        $color->handle = $_POST['handle'];
        //echo $request->input('frame_img');die;
        if($color->save()){
            return new ColorResources($color);
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
         $color = new Color;
        $fTitle = str_replace('quote','"',$_POST['title']);
        $title = str_replace('#',' ',$fTitle);
        $color = Color::find($id);
        $color->frame = $title;
        $color->select_frame_id = $_POST['select_frame_id'];
        $color->frame_img = $_POST['frameimg'];
        $color->frame_id = $_POST['frameid'];
        $color->handle = $_POST['handle'];
        //echo $request->input('frame_img');die;
        if($color->save()){
            return new ColorResources($color);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$frameid)
    {
        $color = Color::findOrFail($id);
         if($color->delete()) {
             new ColorResources($color);
        }

        $baseUrl = 'https://mirrormatellc.myshopify.com/admin/';
        $url = $baseUrl.'custom_collections.json';
       // echo $url;die;
    
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);  
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: POST') );
            //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);
            curl_close($ch);
            $responseData = array();
            $responseArr = json_decode($response);

            foreach ($responseArr as $key => $value) {
                foreach ($value as $k => $val) {
                    $responseData['id'][$k]=$val->id;
                    $responseData['response'][$k]=$val;
                }
            }
            $data = json_decode(json_encode($responseData), true);
            $str = "";
            $Col = '';
            $rand = 'abc12';
            $s3 = 's3';
            $addCol = 'addCol';
            $deleteCol = 'deleteCol';
            $mmId = 'abc';
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
                    $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'","'.$rand.'","'.$mmId.'","'.$frameid.'")>'.$data["response"][$i]["title"].'</a>';
                }

           
        if(!empty($frameid)){
             $selC = DB::select('select * from colors where select_frame_id  = '.$frameid);
             if(count($selC) == 0){ 
                    $Col.='<div class="sc-choice" id="Col'.$rand.$frameid.'"><span class="stepimg">
                          <div class="imgpreview" id="imgpreviewCol'.$rand.$frameid.'" style="background-image: url(stepimg.jpg);"></div></span>
                           <span class="stepbullet">- </span><div class="dropdown step-drop"><button onclick=show("'.$s3.'",'.$frameid.'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextCol'.$rand.$frameid.'">Select</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'.$str.'</div></div><span id="add" class="choicestep" onclick=addFrame("'.$addCol.'",'.$frameid.');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep" onclick=removeFrame("'.trim($rand).'","'.$deleteCol.'",'.$frameid.');><i class="fas fa-minus"></i></span></div><br/ id="brC'.$rand.'">'; 
             }
        }
        
        if($Col != ''){
            echo json_encode($Col);exit;
        }
        else{
            $Col = '';
             echo json_encode($Col);exit;
        }
       
    }

    public function selectData(){
         $selCol = DB::select('select * from colors where select_frame_id  = '.$_POST['FId']);
         $mirrormate = DB::select('select * from mirrormates where id  = '.$_POST['FId']);
            

         //$framename = $mirrormate[0]->frame;
         $addSelCol = '';
         $finalArray = array();
         $random = 'abc12';
         if(!empty($selCol)){
         for($i=0;$i<count($selCol);$i++){
                $addSelCol.='<li id="prevCol'.$selCol[$i]->id.'" onclick=redirectColor("'.$selCol[$i]->handle.'");><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$i.$mirrormate[0]->id.'" style="background-image: url('.$selCol[$i]->frame_img.');"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span>
                    <span class="quizcolor-title" id="ColText'.$i.$mirrormate[0]->id.'">'.$selCol[$i]->frame.'</span></div></div></li>';

         }

        }else{
            $addSelCol.= '<li id="prevCol'.$random.'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$random.$mirrormate[0]->id.'" style="background-image: url(stepimg.jpg);"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span><span class="quizcolor-title" id="ColText'.$random.$mirrormate[0]->id.'">Select</span></div></div></li>';
        }
        //array_merge($mirrormates,$addSelCol);
        //echo "<PRE>";print_r($mirrormates);die;
        $finalArray['addSelCol'] = $addSelCol;
        $finalArray['data'] = $mirrormate;
        return json_encode($finalArray);exit;
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
}
