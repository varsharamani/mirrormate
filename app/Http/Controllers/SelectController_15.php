<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mirrormate;
use App\Color;
use DB;
use App\Http\Resources\mirrormate as MirrormateResources;
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

    public function index()
    {
        
        Session::put('total',1);

       /* $mirrormate = Mirrormate::all();
        #print_r($mirrormate);die;
        //return collection
        
        #print_r($data);die;
        return MirrormateResources::collection($mirrormate);
        //return new MirrormateResources($data);*/
       /* $baseUrl = 'https://a7acdbe5d4d00f7537f7292aa226df09:69e8f92992dbb9056c994d882066aa6d@mirrormatellc.myshopify.com/admin/api/2020-10';
        $url = $baseUrl.'/graphql.json';*/
        //$url = $baseUrl.'sma.json';
       // echo $url;die;

        /*$SHOP_NAME = 'mirrormatellc';
        $API_VERSION = '2020-10';
        $API_KEY = 'a7acdbe5d4d00f7537f7292aa226df09';
        $PASSWORD = '69e8f92992dbb9056c994d882066aa6d';*/

       /* $shop_url = "https://%s:%s@%s.myshopify.com/admin/api/%s" % ($API_KEY, $PASSWORD, $SHOP_NAME, $API_VERSION);*/
        
       // echo $baseUrl;die;

         //$url1 = $baseUrl.'collections/count.json';
        //$total = self::__curl($url1,$this->username, $this->password );
        //echo "<PRE>";print_r($total);die;

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
            //$data = '"query" : "{ collections { edges { node { id,handle,title } } } }"';
            
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: POST') );
            //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
              
            //$responseData = array();
           // $responseArr = json_decode($response);
            foreach ($responseArr as $key => $value) {
                foreach ($value as $k => $val) {
                    $responseData['id'][$k]=$val->id;
                    $responseData['response'][$k]=$val;
                }
            }
            $selFrame = array();
             $frames = DB::select('select * from mirrormates');
             $basic_infos = DB::select('select * from basic_infos');
              $colors = DB::select('select * from colors');
             for($j=0;$j<count($frames);$j++){
                array_push($selFrame,$frames[$j]->frame_id);
             }
            $data = responsedata();
           
        return view ('quiz',['data' => $data,'frames'=>$frames,'selFrame'=>$selFrame,'basic_infos'=>$basic_infos,'colors'=>$colors]);
    }

    function __curl($url,$username,$password){
   
    $ch = curl_init($url);
    //echo $url;die;
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: POST') );
   // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);
    $responseArr = json_decode($response);
    //return count($responseArr);
    return $responseArr;
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

       
         $mirromate = new mirrormate;
        //print_r($ );die;
        $fTitle = str_replace('quote','"',$_POST['title']);
        $title = str_replace('#',' ',$fTitle);
        $mirromate->frame = $title;
        $mirromate->frame_id = $_POST['frameid'];
        $mirromate->frame_img = $_POST['frameimg'];
        $mirromate->handle = $_POST['handle'];
        $mirromate->choose = 'You Choose '.$title;
        $mirromate->choose_desc = 'Now, what color frame would you choose for a picture hung in the bath? (Select one)';
        #echo $request->up_id;die;

        if($mirromate->save()){
             $insertedId = $mirromate->id;
            
        }

        $rand = 'abc12';
        $mmId = '';
        $str = '';
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
                    $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'","'.$rand.'","'.$mmId.'","'.$insertedId.'")>'.$data["response"][$i]["title"].'</a>';
                }
               

        $finalArray = array();
        $allFrame = DB::select('select * from mirrormates');
        $allFrameC = count($allFrame) + 2;
        $frame = 'You choose '.$title;
      
        $s3 = 's3';
        $abc123 = 'abc123';
        $addCol = 'addCol';
        $deleteCol = 'deleteCol';
        $frame_desc = 'Now, what color frame would you choose for a picture hung in the bath? (Select one)';
        $addFrameCol = '';
        $addFrameCol.='<div class="steps" id="frameRemove'.$insertedId.'"><div class="steps-box step-shadow"><div class="step-no"><div class="step-type"><i class="far fa-image"></i> <span>'.$allFrameC.'</span></div></div><div class="step-content"><div class="steprow"><div class="step-title"><a onclick=show("'.trim($s3).'",'.$insertedId.');><textarea onkeyup=change_info('.$insertedId.'); class="form-control sr-area" name="" id="choose'.$insertedId.'" rows="1" >'.$mirromate->choose.'</textarea></a></div><div class="step-description"><a onclick=show("'.trim($s3).'",'.$insertedId.');><textarea class="form-control sr-area" name="" onkeyup=change_info('.$insertedId.'); id="choose_desc'.$insertedId.'" rows="1">'.$mirromate->choose_desc.'</textarea></a></div><div class="step-choice w-100 mb-30"><div id="" class="new-choice"><div class="sc-row"><hr><div class="sc-choice" id="Col'.$rand.'"><span class="stepimg"><div class="imgpreview" id="imgpreviewCol'.$rand.$insertedId.'" style="background-image: url(stepimg.jpg);"></div></span><span class="stepbullet">- </span><div class="dropdown step-drop"><button onclick=show("'.trim($s3).'",'.$insertedId.'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextCol'.$rand.$insertedId.'">Select</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">"'.$str.'"</div>
            </div><span id="add" class="choicestep" onclick=addFrame("'.$addCol.'",'.$insertedId.');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep" onclick=removeFrame("'.trim($rand).'","'.$deleteCol.'",'.$insertedId.');><i class="fas fa-minus"></i></span></div><br/><div id="addCol'.$insertedId.'"></div></div></div></div></div></div></div></div>';
        
        $finalArray['addFrameCol'] = $addFrameCol;
        $finalArray['insertedId'] = $insertedId;
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
        $mirromate->frame = $_POST['title'];
        $mirromate->frame_id = $_POST['frameid'];
        $mirromate->frame_img = $_POST['frameimg'];
        $mirromate->handle = $_POST['handle'];
        #echo $request->up_id;die;
        if($mirromate->save()){
            return new MirrormateResources($mirromate);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $mirromate = mirrormate::findOrFail($id);
        #echo $article;die;

        if($mirromate->delete()) {
            Color::where('select_frame_id',$id)->delete(); 
            return new MirrormateResources($mirromate);
        }
    }

    public function addFrame(){
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
            $str=$addCol= '';
            $random = rand();
            $mmId = 'abc';
            $s3 = 's3';
            $finalArr = array();
            $previewFrame = '';
            $deleteCol = "deleteCol";
            if($_POST['type'] == 'addFrame'){
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
                $addCol.='<div class="sc-choice" id="'.$random.'"><span class="stepimg"><div class="imgpreview" id="imgpreview'.$random.'" style="background-image: url(stepimg.jpg);"></div></span><span class="stepbullet">- </span>';
                $addCol.='<div class="dropdown step-drop"><button  class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntext'.$random.'">Select</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">"'.$str.'"</div></div><span id="add" class="choicestep" onclick=addFrame("'.trim($_POST['type']).'");><i class="fas fa-plus"></i></span>
                <span id="remove" class="choicestep '.$random.'" onclick=removeFrame("'.$random.'","'.$mmId.'");><i class="fas fa-minus"></i></span></div><br/ id="brF'.$random.'">';

                  $previewFrame.= '<li id="prevFrame'.$random.'"><div class="quizimg-box"><div class="quizimg-thumb" id="FrameImg'.$random.'" style="background-image: url(stepimg.jpg);"></div><div class="quizimg-inner"><span class="quizimg-radio"></span>
                <span class="quizimg-title" id="FrameText'.$random.'">Select</span></div></div></li>';
            }else{
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
                    $str.='<a class="dropdown-item" href="javascript:void(0);" onclick=selColor("'.$title_str.'",'.$data["response"][$i]["id"].',"'.$img.'","'.$handle.'",'.$random.',"'.$mmId.'","'.$_POST['FId'].'")>'.$data["response"][$i]["title"].'</a>';
                }
                $addCol.='<div class="sc-choice" id="Col'.$random.'"><span class="stepimg"><div class="imgpreview" id="imgpreviewCol'.$random.$_POST['FId'].'" style="background-image: url(stepimg.jpg);"></div></span><span class="stepbullet">- </span>';
                $addCol.='<div class="dropdown step-drop"><button onclick=show("'.$s3.'",'.$_POST['FId'].'); class="btn btn-themec dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="btntextCol'.$random.$_POST['FId'].'">Select</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">"'.$str.'"</div></div><span id="add" class="choicestep" onclick=addFrame("'.$_POST['type'].'",'.$_POST['FId'].');><i class="fas fa-plus"></i></span><span id="remove" class="choicestep" onclick=removeFrame("'.$random.'","'.$deleteCol.'","'.$_POST['FId'].'");><i class="fas fa-minus"></i></span></div><br/ id="brC'.$random.'">';

                $previewFrame.='<li id="prevCol'.$random.'"><div class="quizcolor-box"><div class="quizcolor-thumb" id="ColImg'.$random.$_POST['FId'].'" style="background-image: url(stepimg.jpg);"></div><div class="quizcolor-inner"><span class="quizcolor-radio"></span><span class="quizcolor-title" id="ColText'.$random.$_POST['FId'].'">Select</span></div></div></li>';
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
        $mirrormate = DB::select('select * from mirrormates where frame_id  = '.$_POST['frameid']);
        if(!empty($mirrormate)){
            $fname = $mirrormate[0]->frame;
        }else{
            $fname = '';
        }

        return json_encode($fname);exit;
    }

    public function change_info($id){
        $mirromate = new mirrormate;
        $mirromate = Mirrormate::find($id);
        $mirromate->choose = $_POST['choose'];
        $mirromate->choose_desc = $_POST['choose_desc'];
       
        #echo $request->up_id;die;
        if($mirromate->save()){
            return new MirrormateResources($mirromate);
        }
    }
}
