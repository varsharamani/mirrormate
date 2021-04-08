<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Color;
use Session;
use DB;


use App\Http\Resources\color as ColorResources;

class colorController extends Controller
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

    public function getData()
    {
         $Color = Color::all();
         return ColorResources::collection($Color);
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
        /*$mirromate = $request->isMethod('put') ? Color::where('frame_id',$request->up_id)->first() : new mirrormate;*/
        //print_r($_POST);die;
        $color->frame = $_POST['title'];
        $color->select_frame_id = $_POST['select_frame_id'];
        $color->frame_img = $_POST['frameimg'];
        $color->frame_id = $_POST['frameid'];
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $article = Color::findOrFail($id);
        if($article->delete()) {
            return new ColorResources($article);
        }
    }
}
