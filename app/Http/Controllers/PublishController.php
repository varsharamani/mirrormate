<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use App\basicInfo;
use DB;
use App\Http\Resources\basicInfo as BasicInfoResources;

class PublishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$quizId)
    {
        $basicInfo = DB::select('select * from basic_infos');
         $quizData = DB::select('select * from quiz where id = '.$quizId);
         return view ('publish',['data' => $basicInfo,'quizId'=>$quizId,'quizData'=>$quizData]);
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
        $basicInfo = new basicInfo;
        if($_POST['data'] == 1){
            $basicInfo->next_btntext = $_POST['next_btntext'];
            $basicInfo->previous_btntext = $_POST['previous_btntext'];
            $basicInfo->showresult_btntext = $_POST['showresult_btntext'];
            $basicInfo->next_btnbgcolor = $_POST['next_btnbgcolor'];
            $basicInfo->next_btn_text_color = $_POST['next_btn_text_color'];
            $basicInfo->next_fsize = $_POST['next_fsize'];
            $basicInfo->next_bradius = $_POST['next_bradius'];
        }
        elseif($_POST['data'] == 2){
            /*$basicInfo->btn_popup_width = $_POST['btn_popup_width'];
            $basicInfo->btn_popup_height = $_POST['btn_popup_height'];*/
             $basicInfo->bgcolor = $_POST['bg_color'];
            $basicInfo->btn_text = $_POST['btntext'];
            $basicInfo->btn_bgcolor = $_POST['btncolor'];
            $basicInfo->btn_font_size = $_POST['fsize'];
            $basicInfo->btn_border_radius = $_POST['bradius'];
            $basicInfo->btn_txtcolor = $_POST['btn_text_color'];
        }
       // print_r($basicInfo);die;
        if($basicInfo->save()){
            return new BasicInfoResources($basicInfo);
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
         $basicInfo = new basicInfo;
        $basicInfo = basicInfo::find($id);
        if($_POST['data'] == 1){
            $basicInfo->next_btntext = $_POST['next_btntext'];
             $basicInfo->previous_btntext = $_POST['previous_btntext'];
              $basicInfo->showresult_btntext = $_POST['showresult_btntext'];
            $basicInfo->next_btnbgcolor = $_POST['next_btnbgcolor'];
            $basicInfo->next_btn_text_color = $_POST['next_btn_text_color'];
            $basicInfo->next_fsize = $_POST['next_fsize'];
            $basicInfo->next_bradius = $_POST['next_bradius'];

        }
        elseif($_POST['data'] == 2){
          /*  $basicInfo->btn_popup_width = $_POST['btn_popup_width'];
            $basicInfo->btn_popup_height = $_POST['btn_popup_height'];*/
            $basicInfo->bgcolor = $_POST['bg_color'];
            $basicInfo->btn_text = $_POST['btntext'];
            $basicInfo->btn_bgcolor = $_POST['btncolor'];
            $basicInfo->btn_font_size = $_POST['fsize'];
            $basicInfo->btn_border_radius = $_POST['bradius'];
            $basicInfo->btn_txtcolor = $_POST['btn_text_color'];
        }

        if($basicInfo->save()){
            return new BasicInfoResources($basicInfo);
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
        //
    }
}
