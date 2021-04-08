<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use App\basicInfo;
use DB;
use App\Http\Resources\basicInfo as BasicInfoResources;
use Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basicInfo = DB::select('select * from basic_infos');
        return view ('home',['data' => $basicInfo]);
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
        $basicInfo->title_1 = $_POST['title_1'];
        $basicInfo->title_2 = $_POST['title_2'];
        $basicInfo->subtitle_1 = $_POST['subtitle_1'];
        $basicInfo->subtitle_2 = $_POST['subtitle_2'];
       /* $basicInfo->bgcolor = $_POST['bgcolor'];
        $basicInfo->btn_bgcolor = $_POST['btnbgcolor'];
        $basicInfo->btn_txtcolor = $_POST['btntextcolor'];*/

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
        $basicInfo->title_1 = $_POST['title_1'];
        $basicInfo->title_2 = $_POST['title_2'];
        $basicInfo->subtitle_1 = $_POST['subtitle_1'];
        $basicInfo->subtitle_2 = $_POST['subtitle_2'];
       /* $basicInfo->bgcolor = $_POST['bgcolor'];
        $basicInfo->btn_bgcolor = $_POST['btnbgcolor'];
        $basicInfo->btn_txtcolor = $_POST['btntextcolor'];*/

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
         $allFrame = DB::select('select * from mirrormates where quiz_id = '.$id);
         for($i=0;$i<count($allFrame);$i++){
             DB::delete('delete from colors where select_frame_id = '.$allFrame[$i]->id);
              DB::delete('delete from frame_cols where sel_frame_id = '.$allFrame[$i]->id);
         }
         DB::delete('delete from quiz where id = '.$id);
         DB::delete('delete from mirrormates where quiz_id = '.$id);
         DB::delete('delete from basic_infos where quiz_id = '.$id);

    }

     public function storeQuiz(Request $request)
    {
        //print_r($_POST);die;
      /* if(isset($_POST['quiz_id'])){
          Session::put('quizId', $_POST['quiz_id']);  
       }*/
          $id = DB::table('quiz')->insertGetId( ['quiz_name'=>$_POST['qname']]);
          //Session::put('quizId', $id);  
       
             DB::table('basic_infos')->insertGetId( ['quiz_id'=>$id,'title_1'=>'With 65 frame styles it can be hard to choose! ','title_2'=>'Take our quiz and find the style that fits you best. ','subtitle_1'=>"Let's start with your style. Is it more... ",'subtitle_2'=>"(Select one. Don’t worry you can take this quiz again!)",'bgcolor'=>'#aaffff','btn_bgcolor'=>"#008a8a",'btn_txtcolor'=>"#ffffff",'btn_text'=>'TAKE OUR QUIZ','btn_font_size'=>"21",'btn_border_radius'=>"8",'next_btnbgcolor'=>"#008a8a",'next_btn_text_color'=>"#ffffff",'next_btntext'=>'Next','previous_btntext'=>'Previous','showresult_btntext'=>'Show Result','next_fsize'=>"21",'next_bradius'=>"8"]);
            echo json_encode($id);die;
         
    }

    public function editQuiz(){
        //print_r($_POST);die;
        if(isset($_POST['quiz_id'])){
          //Session::put('quizId', $_POST['quiz_id']);  
       }
    }

    public function publishQuiz(Request $request){
         if(isset($_POST['quiz_id'])){
            Session::put('quizId', $_POST['quiz_id']);  
         }
    }

    public function matrixData($quizId){
        //echo $quizId;die;
        $startDate = date('Y-m-d',strtotime("-30 days"));
        $endDate   = date('Y-m-d',strtotime("now"));
       $oldDate = date('Y-m-d', strtotime('-1 month', strtotime($startDate)));

       $quizData = DB::select('SELECT * from quiz where id = '.$quizId);
       $responseData = DB::select('SELECT * from tbl_quizInfo where quiz_id = '.$quizId.' order by created_at DESC limit 100');
       
        //echo $endDate;die;
      // echo 'SELECT date(created_at) as created_at, count(*) as status FROM tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND created_at >= "'.$startDate.'" and created_at <= "'.$endDate.'" Group by date(created_at) order by date(created_at)';die;
        $newstartsDataT = DB::select('SELECT date(created_at) as created_at, count(*) as status FROM tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND created_at >= "'.$startDate.'" and created_at <= "'.$endDate.'" Group by date(created_at) order by date(created_at)');

        $oldstartsDataT = DB::select('SELECT date(created_at) as created_at, count(*) as status FROM tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND created_at >= "'.$oldDate.'" and created_at <= "'.$startDate.'" Group by date(created_at) order by date(created_at)');
      //echo "<PRE>";print_r($oldstartsDataT);die;
        //$startsData = DB::table('tbl_matrix')->where('quiz_id',$quizId)->where('status',1)->where('created_at','>=',$startDate)->where('created_at','<=',$endDate)->groupBy('created_at')->get()->toArray();
        $new_chart_data = '';
        foreach($newstartsDataT as $key => $value)
        {
            $str = ''; 
            $array=explode("-",$value->created_at); 

            if($array[1] == '01'){
                 $startDate1 = date('Y-m-d',strtotime($value->created_at));
                 $startDate11 = date('Y-m-d',strtotime($startDate1." -1 Months"));
                 $prevDate = explode("-",$startDate11);
                 $array[1] = $prevDate[1];
                 $array[0] = $prevDate[0];

            }
            $str = 'Date.UTC('.$array[0].','.$array[1].','.$array[2].')';
            $new_chart_data .= "[".$str.",".$value->status."], ";
            //$new_chart_data .= $value->status.',';
        }
       // $new_chart_data = substr($new_chart_data, 0, -2);
        $new_chart_data = rtrim($new_chart_data,' ,');

        $old_chart_data = '';
        foreach($oldstartsDataT as $key1 => $value1)
        {
         /*$old_chart_data .= "['".$value1->created_at."',".$value1->status."], ";*/
            $strOld = ''; 
            $array_old=explode("-",$value1->created_at); 
            if($array_old[1] == '01'){
                 $startDateOld = date('Y-m-d',strtotime($value1->created_at));
                 $startDateOld1 = date('Y-m-d',strtotime($startDateOld." -1 Months"));
                 $prevDateOld = explode("-",$startDateOld1);
                 $array_old[1] = $prevDateOld[1];
                 $array_old[0] = $prevDateOld[0];

            }
            $str = 'Date.UTC('.$array_old[0].','.$array_old[1].','.$array_old[2].')';
            $old_chart_data .= "[".$str.",".$value1->status."], ";
        }
        $old_chart_data = rtrim($old_chart_data,' ,');
        
            //echo $old_chart_data;die;
        
       
        $startsData = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND created_at >= "'.$startDate.'" and created_at <= "'.$endDate.'"');
        //echo 'select * from tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND created_at >= "'.$startDate.'" and created_at <= "'.$endDate.'"';die;
        $finishData = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 2 AND created_at >= "'.$startDate.'" and created_at <= "'.$endDate.'"');
        $cartData = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND created_at >= "'.$startDate.'" and created_at <= "'.$endDate.'"');
         //echo '<PRE>sdata';print_r($startsData);die;
        return view('matrix',['quizData'=>$quizData,'quizId'=>$quizId,'startsData'=>$startsData,'finishData'=>$finishData,'cartData'=>$cartData,'new_chart_data'=>$new_chart_data,'old_chart_data'=>$old_chart_data,'startDate'=>$startDate,'endDate'=>$endDate,'responseData'=>$responseData]);
    }

    public function matrixFilterData($quizId){
        if(!empty($_POST['date'])){
            $dateArr = explode(" - ",$_POST['date']);
            $startDate = $dateArr[0];
            $endDate   = $dateArr[1];
            $oldDateS = date('Y-m-d', strtotime('-1 month', strtotime($startDate)));
            $oldDateE = date('Y-m-d', strtotime('-1 month', strtotime($endDate)));
        //    echo $oldDateS.'<br/>'.$oldDateE;die;

        //startData
        $newstartsData = DB::select('SELECT date(created_at) as created_at, count(*) as status FROM tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND date(created_at) >= "'.$startDate.'" and date(created_at) <= "'.$endDate.'" Group by date(created_at)  order By created_at ASC');

        $oldstartsData = DB::select('SELECT date(created_at) as created_at, count(*) as status FROM tbl_matrix where quiz_id='.$quizId.' AND status = 1 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'" Group by date(created_at) order By created_at ASC');
        
        //echo "<PRE>";print_r($newstartsData);die;
        $new_chart_data = '';
        $totalStarts = array();
        $tStarts = 5;
        foreach($newstartsData as $key => $value){
            $str = ''; 
            $array=explode("-",$value->created_at); 
                 $startDate1 = date('Y-m-d',strtotime($value->created_at));
                 $startDate11 = date('Y-m-d',strtotime($startDate1." -1 Months"));
                 $prevDate = explode("-",$startDate11);
                 $array[1] = $prevDate[1];
                 $array[0] = $prevDate[0];
            $str = 'Date.UTC('.$array[0].','.$array[1].','.$array[2].')';
            $new_chart_data .= "[".$str.",".$value->status."], ";
            array_push($totalStarts,$value->status);
            $tStarts = max($totalStarts);
        }
        
        $new_chart_data = rtrim($new_chart_data,' ,');

        $old_chart_data = '';
        $totalStartsold = array();
        $tStartsold = 5;
        foreach($oldstartsData as $key1 => $value1){
            $strOld = ''; 
            $array_old=explode("-",$value1->created_at); 
            /*if($array_old[1] == '01'){
                 $startDateOld = date('Y-m-d',strtotime($value1->created_at));
                 $startDateOld1 = date('Y-m-d',strtotime($startDateOld." -1 Months"));
                 $prevDateOld = explode("-",$startDateOld1);
                 $array_old[1] = $prevDateOld[1];
                 $array_old[0] = $prevDateOld[0];

            }*/
            $str = 'Date.UTC('.$array_old[0].','.$array_old[1].','.$array_old[2].')';
            $old_chart_data .= "[".$str.",".$value1->status."], ";
            array_push($totalStartsold,$value1->status);
            $tStartsold = max($totalStartsold);
        }
        $old_chart_data = rtrim($old_chart_data,' ,');

        $seriesDataS = '';
        $seriesDataS.='[{ name:"Current Period", data: ['.$new_chart_data.'] }, { name:"Previous Period", data: ['.$old_chart_data.'] }]';

        //response Data
         $newresponseData = DB::select('SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 2 AND date(created_at) >= "'.$startDate.'" and date(created_at) <= "'.$endDate.'" Group by date(created_at)  order By created_at ASC');

        $oldresponseData = DB::select('SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 2 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'" Group by date(created_at) order By created_at ASC');
       //echo 'SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 2 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'" Group by date(created_at) order By created_at ASC';die;
        //echo "<PRE>";print_r($oldresponseData);die;
        $new_chart_dataR = '';
        $totalResponses = array();
        $tResponses = 5;
        foreach($newresponseData as $key => $value){
            $str = ''; 
            $array=explode("-",$value->created_at); 
                 $startDate1 = date('Y-m-d',strtotime($value->created_at));
                 $startDate11 = date('Y-m-d',strtotime($startDate1." -1 Months"));
                 $prevDate = explode("-",$startDate11);
                 $array[1] = $prevDate[1];
                 $array[0] = $prevDate[0];
           
            $str = 'Date.UTC('.$array[0].','.$array[1].','.$array[2].')';
            $new_chart_dataR .= "[".$str.",".$value->count."], ";
            array_push($totalResponses,$value->count);
            $tResponses = max($totalResponses);
        }
        $new_chart_dataR = rtrim($new_chart_dataR,' ,');

        $old_chart_dataR = '';
        $totalResponsesold = array();
        $tResponsesold = 5;
        foreach($oldresponseData as $key1 => $value1){
            $strOld = ''; 
            $array_old=explode("-",$value1->created_at); 
            /*if($array_old[1] == '01'){
                 $startDateOld = date('Y-m-d',strtotime($value1->created_at));
                 $startDateOld1 = date('Y-m-d',strtotime($startDateOld." -1 Months"));
                 $prevDateOld = explode("-",$startDateOld1);
                 $array_old[1] = $prevDateOld[1];
                 $array_old[0] = $prevDateOld[0];

            }*/
            $str = 'Date.UTC('.$array_old[0].','.$array_old[1].','.$array_old[2].')';
            $old_chart_dataR .= "[".$str.",".$value1->count."], ";
            array_push($totalResponsesold,$value1->count);
            $tResponsesold = max($totalResponsesold);
        }
        $old_chart_dataR = rtrim($old_chart_dataR,' ,');

        $seriesDataR = '';
        $seriesDataR.='[{ name:"Current Period", data: ['.$new_chart_dataR.'] }, { name:"Previous Period", data: ['.$old_chart_dataR.'] }]';

        //Num Carts Data
        $newnumCartData = DB::select('SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND date(created_at) >= "'.$startDate.'" and date(created_at) <= "'.$endDate.'" Group by date(created_at)  order By created_at ASC');

        $oldnumCartData = DB::select('SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'" Group by date(created_at) order By created_at ASC');

        //echo "<PRE>";print_r($oldresponseData);die;
         $new_chart_dataNC = '';
        $totalnumCart = array();
        $tnumCart = 5;
        foreach($newnumCartData as $key => $value){
            $str = ''; 
            $array=explode("-",$value->created_at); 
                 $startDate1 = date('Y-m-d',strtotime($value->created_at));
                 $startDate11 = date('Y-m-d',strtotime($startDate1." -1 Months"));
                 $prevDate = explode("-",$startDate11);
                 $array[1] = $prevDate[1];
                 $array[0] = $prevDate[0];
           
            $str = 'Date.UTC('.$array[0].','.$array[1].','.$array[2].')';
            $new_chart_dataNC .= "[".$str.",".$value->count."], ";
            array_push($totalnumCart,$value->count);
            $tnumCart = max($totalnumCart);
        }
        $new_chart_dataNC = rtrim($new_chart_dataNC,' ,');

        $old_chart_dataNC = '';
        $totalnumCartold = array();
        $tnumCartold = 5;
        foreach($oldnumCartData as $key1 => $value1){
            $strOld = ''; 
            $array_old=explode("-",$value1->created_at); 
            /*if($array_old[1] == '01'){
                 $startDateOld = date('Y-m-d',strtotime($value1->created_at));
                 $startDateOld1 = date('Y-m-d',strtotime($startDateOld." -1 Months"));
                 $prevDateOld = explode("-",$startDateOld1);
                 $array_old[1] = $prevDateOld[1];
                 $array_old[0] = $prevDateOld[0];

            }*/
            $str = 'Date.UTC('.$array_old[0].','.$array_old[1].','.$array_old[2].')';
            $old_chart_dataNC .= "[".$str.",".$value1->count."], ";
             array_push($totalnumCartold,$value1->count);
            $tnumCartold = max($totalnumCartold);
        }
        $old_chart_dataNC = rtrim($old_chart_dataNC,' ,');

        $seriesDataNC = '';
        $seriesDataNC.='[{ name:"Current Period", data: ['.$new_chart_dataNC.'] }, { name:"Previous Period", data: ['.$old_chart_dataNC.'] }]';

        //com Rate Data
        $new_chart_dataCR = '';  
        $totalComRate = array();
        $tComRate = 5; 
        if(!empty($newresponseData)){
            for($i=0;$i<count($newresponseData);$i++){
                $comRate1 = '0';
                $crStart = DB::select('SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND date(created_at) = "'.$newresponseData[$i]->created_at.'" Group by date(created_at)');

                if(!empty($crStart)){
                   /* echo $newresponseData[$i]->count.'<br/>xx'.$crStart[0]->count.'end';*/
                     $comRate1 = (($newresponseData[$i]->count*100)/$crStart[0]->count);
                    $array=explode("-",$newresponseData[$i]->created_at); 
                     $startDate1 = date('Y-m-d',strtotime($newresponseData[$i]->created_at));
                     $startDate11 = date('Y-m-d',strtotime($startDate1." -1 Months"));
                     $prevDate = explode("-",$startDate11);
                     $array[1] = $prevDate[1];
                     $array[0] = $prevDate[0];
               
                    $str = 'Date.UTC('.$array[0].','.$array[1].','.$array[2].')';
                    $new_chart_dataCR .= "[".$str.",".round($comRate1,'2')."], ";
                    array_push($totalComRate, $comRate1);
                    $tComRate = max($totalComRate);
                }
            }
        }

        $old_chart_dataCR = '';
        $totalComRateold = array();
        $tComRateold = 5; 
        if(!empty($oldresponseData)){
            for($i=0;$i<count($oldresponseData);$i++){
                $comRate1 = '0';
                $crStartOld = DB::select('SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND date(created_at) = "'.$oldresponseData[$i]->created_at.'" Group by date(created_at)');

                if(!empty($crStartOld)){
                   /* echo $newresponseData[$i]->count.'<br/>xx'.$crStart[0]->count.'end';*/
                     $comRate1 = (($oldresponseData[$i]->count*100)/$crStartOld[0]->count);
                    $arrayold=explode("-",$oldresponseData[$i]->created_at); 
                     /*$startDate1 = date('Y-m-d',strtotime($oldresponseData[$i]->created_at));
                     $startDate11 = date('Y-m-d',strtotime($startDate1." -1 Months"));
                     $prevDate = explode("-",$startDate11);
                     $arrayold[1] = $prevDate[1];
                     $arrayold[0] = $prevDate[0];*/
               
                    $str = 'Date.UTC('.$arrayold[0].','.$arrayold[1].','.$arrayold[2].')';
                    $old_chart_dataCR .= "[".$str.",".round($comRate1,'2')."], ";
                    array_push($totalComRateold, $comRate1);
                    $tComRateold = max($totalComRateold);
                }
            }
        }
         $new_chart_dataCR = rtrim($new_chart_dataCR,' ,');
          $old_chart_dataCR = rtrim($old_chart_dataCR,' ,');
          $seriesDataCR = '';
        $seriesDataCR.='[{ name:"Current Period", data: ['.$new_chart_dataCR.'] }, { name:"Previous Period", data: ['.$old_chart_dataCR.'] }]';

        //Total carts value
         $newtotalCartsVData = DB::select('SELECT date(created_at) as created_at, SUM(price) AS TotalPrice FROM tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND date(created_at) >= "'.$startDate.'" and date(created_at) <= "'.$endDate.'" Group by date(created_at)  order By created_at ASC');

        $oldtotalCartsVData = DB::select('SELECT date(created_at) as created_at, SUM(price) AS TotalPrice FROM tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'" Group by date(created_at) order By created_at ASC');
       //echo 'SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 2 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'" Group by date(created_at) order By created_at ASC';die;
        //echo "<PRE>";print_r($oldresponseData);die;
         $new_chart_dataTCV = '';
        $totalTCV = array();
        $tTCV = 5; 
        foreach($newtotalCartsVData as $key => $value){
            $str = ''; 
            $array=explode("-",$value->created_at); 
                 $startDate1 = date('Y-m-d',strtotime($value->created_at));
                 $startDate11 = date('Y-m-d',strtotime($startDate1." -1 Months"));
                 $prevDate = explode("-",$startDate11);
                 $array[1] = $prevDate[1];
                 $array[0] = $prevDate[0];
           
            $str = 'Date.UTC('.$array[0].','.$array[1].','.$array[2].')';
            $new_chart_dataTCV .= "[".$str.",".$value->TotalPrice."], ";
            array_push($totalTCV, $value->TotalPrice);
            $tTCV = max($totalTCV);
        }
        $new_chart_dataTCV = rtrim($new_chart_dataTCV,' ,');

        $old_chart_dataTCV = '';
        $totalTCVold = array();
        $tTCVold = 5; 
        foreach($oldtotalCartsVData as $key1 => $value1){
            $strOld = ''; 
            $array_old=explode("-",$value1->created_at); 
            /*if($array_old[1] == '01'){
                 $startDateOld = date('Y-m-d',strtotime($value1->created_at));
                 $startDateOld1 = date('Y-m-d',strtotime($startDateOld." -1 Months"));
                 $prevDateOld = explode("-",$startDateOld1);
                 $array_old[1] = $prevDateOld[1];
                 $array_old[0] = $prevDateOld[0];

            }*/
            $str = 'Date.UTC('.$array_old[0].','.$array_old[1].','.$array_old[2].')';
            $old_chart_dataTCV .= "[".$str.",".$value1->TotalPrice."], ";
            array_push($totalTCVold, $value1->TotalPrice);
            $tTCVold = max($totalTCVold);
        }
        $old_chart_dataTCV = rtrim($old_chart_dataTCV,' ,');

        $seriesDataTCV = '';
        $seriesDataTCV.='[{ name:"Current Period", data: ['.$new_chart_dataTCV.'] }, { name:"Previous Period", data: ['.$old_chart_dataTCV.'] }]';

        //Average carts value
         $newavgCartsVData = DB::select('SELECT date(created_at) as created_at, SUM(price) AS TotalPrice,count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND date(created_at) >= "'.$startDate.'" and date(created_at) <= "'.$endDate.'" Group by date(created_at)  order By created_at ASC');

        $oldavgCartsVData = DB::select('SELECT date(created_at) as created_at, SUM(price) AS TotalPrice,count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'" Group by date(created_at) order By created_at ASC');
       //echo 'SELECT date(created_at) as created_at, count(*) as count FROM tbl_matrix where quiz_id='.$quizId .' AND status = 2 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'" Group by date(created_at) order By created_at ASC';die;
        //echo "<PRE>";print_r($oldresponseData);die;
        $new_chart_dataACV = '';
        $totalACV = array();
        $tACV = 5; 
        foreach($newavgCartsVData as $key => $value){
            $str = ''; 
            $array=explode("-",$value->created_at); 
                 $startDate1 = date('Y-m-d',strtotime($value->created_at));
                 $startDate11 = date('Y-m-d',strtotime($startDate1." -1 Months"));
                 $prevDate = explode("-",$startDate11);
                 $array[1] = $prevDate[1];
                 $array[0] = $prevDate[0];
           
            $str = 'Date.UTC('.$array[0].','.$array[1].','.$array[2].')';
            $newavgVal = 0;
            $newavgVal = $value->TotalPrice/$value->count;
            $new_chart_dataACV .= "[".$str.",".$newavgVal."], ";
            array_push($totalACV,$newavgVal);
            $tACV = max($totalACV);
        }
        $new_chart_dataACV = rtrim($new_chart_dataACV,' ,');

        $old_chart_dataACV = '';
        $totalACVold = array();
        $tACVold = 5; 
        foreach($oldavgCartsVData as $key1 => $value1){
            $strOld = ''; 
            $array_old=explode("-",$value1->created_at); 
            /*if($array_old[1] == '01'){
                 $startDateOld = date('Y-m-d',strtotime($value1->created_at));
                 $startDateOld1 = date('Y-m-d',strtotime($startDateOld." -1 Months"));
                 $prevDateOld = explode("-",$startDateOld1);
                 $array_old[1] = $prevDateOld[1];
                 $array_old[0] = $prevDateOld[0];

            }*/
            $str = 'Date.UTC('.$array_old[0].','.$array_old[1].','.$array_old[2].')';
            $oldavgVal = 0;
            $oldavgVal = $value1->TotalPrice/$value1->count;
            $old_chart_dataACV .= "[".$str.",".$oldavgVal."], ";
            array_push($totalACVold,$oldavgVal);
            $tACVold = max($totalACVold);
        }
        $old_chart_dataACV = rtrim($old_chart_dataACV,' ,');

        $seriesDataACV = '';
        $seriesDataACV.='[{ name:"Current Period", data: ['.$new_chart_dataACV.'] }, { name:"Previous Period", data: ['.$old_chart_dataACV.'] }]';

       

        //all Data
        $startsData = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND date(created_at) >= "'.$startDate.'" and date(created_at) <= "'.$endDate.'"');
        $finishData = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 2 AND date(created_at) >= "'.$startDate.'" and date(created_at) <= "'.$endDate.'"');
        $cartData = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND date(created_at) >= "'.$startDate.'" and date(created_at) <= "'.$endDate.'"');
        }

        //
        $startsDataOld = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'"');
        $finishDataOld = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 2 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'"');
        $cartDataOld = DB::select('select * from tbl_matrix where quiz_id='.$quizId .' AND status = 3 AND date(created_at) >= "'.$oldDateS.'" and date(created_at) <= "'.$oldDateE.'"');
        //echo 'select * from tbl_matrix where quiz_id='.$quizId .' AND status = 1 AND created_at >= "'.$startDate.'" and created_at <= "'.$endDate.'"';die;
        
       // echo "<PRE>";print_r($startsData);die;
        $perStart = 0;
        $perResponse = 0;
        $perComRate = 0;
        $pernumCarts = 0;
        $perTotalAmount = 0;
        $perAvgAmount = 0;
        if(!empty($startsData) && !empty($startsDataOld)){
        $perStart = (((count($startsData) - count($startsDataOld)) / count($startsDataOld))*100);
        }
        if(!empty($finishData) && !empty($finishDataOld)){
        $perResponse = (((count($finishData) - count($finishDataOld)) / count($finishDataOld))*100);
        }
        $comRateNew = '0';
        if(!empty($finishData) && !empty($startsData)){
            $comRateNew = ((count($finishData)*100)/count($startsData));
        }

        $comRateOld = '0';
        if(!empty($finishDataOld) && !empty($startsDataOld)){
            $comRateOld = ((count($finishDataOld)*100)/count($startsDataOld));
        }
        if($comRateOld != '0'  && $comRateNew != '0'){
        $perComRate = ((($comRateNew - $comRateOld) / $comRateOld)*100);
        }

        if(!empty($cartData) && !empty($cartDataOld)){
            $pernumCarts = (((count($cartData) - count($cartDataOld)) / count($cartDataOld))*100);
        }

        $allamountNew = 0;
       // echo "<PRE>";print_r($cartData);die;
        for($p=0;$p<count($cartData);$p++){
            $pricerpl = str_replace('<del>','',$cartData[$p]->price);
            $pricerpl = str_replace('</del>','',$pricerpl);
            $allamountNew+= $pricerpl;
        }
        //echo $allamountNew;die;
        $allamountOld = 0;
        for($p=0;$p<count($cartDataOld);$p++){
            $allamountOld+= $cartDataOld[$p]->price;
        }

        if($allamountNew != '0'  && $allamountOld != '0'){
            $perTotalAmount = ((($allamountNew - $allamountOld) / $allamountOld)*100);
        }

        $avgamountNew = 0;
        if(!empty($cartData)){
            $avgamountNew = $allamountNew / count($cartData);
        }

        $avgamountOld = 0;
        if(!empty($cartDataOld)){
        $avgamountOld = $allamountOld / count($cartDataOld);
        }
      
        if($avgamountNew != '0'  && $avgamountOld != '0'){
            $perAvgAmount = ((($avgamountNew - $avgamountOld) / $avgamountOld)*100);
        }

       /* echo $comRateNew.'v'.$comRateOld.'<br/>';
        echo round($perComRate,'2');die;*/
        //echo "<PRE>";print_r($cartData);die;
        $Start = 'NaN';
        if(!empty($startsData)){
            $Start = count($startsData)/1000;
        }
         $finish = 'NaN';
        if(!empty($finishData)){
             $finish = count($finishData)/1000;
        }
        $numCarts = 'NaN';
        if(!empty($cartData)){
            $numCarts = count($cartData);
        }
        $numCartsSum = '0';
        if(!empty($cartData)){
            for($i=0;$i<count($cartData);$i++){
                $price = '';
                 $pricerpl1 = str_replace('<del>','',$cartData[$i]->price);
                $pricerpl1 = str_replace('</del>','',$pricerpl1);
                $price = str_replace('$','', $pricerpl1);
                $numCartsSum = $numCartsSum+$price;
            }
            
        }
        $numCartsAvg = '0';
        if($numCartsSum != 0){
            $numCartsAvg = $numCartsSum/count($cartData);
        }

        $comRate = '0';
        if(!empty($finishData)){
            $comRate = ((count($finishData)*100)/count($startsData));
        }

        //echo $new_chart_data.'<br/>c'.$old_chart_data;die;
       


        $data = array();
         $data['StartDate'] = $startDate;
        $data['EndDate'] = $endDate;
        $data['Start'] = $Start;
        $data['finish'] = $finish;
        $data['numCarts'] = $numCarts;
        $data['numCartsSum'] = round($numCartsSum,'2');
        $data['numCartsAvg'] = round($numCartsAvg,'2');
        $data['comRate'] = round($comRate,'2');
        $data['new_chart_data'] = $new_chart_data;
        $data['seriesDataS'] = $seriesDataS;
        $data['seriesDataR'] = $seriesDataR;
        $data['seriesDataCR'] = $seriesDataCR;
        $data['seriesDataNC'] = $seriesDataNC;
        $data['seriesDataTCV'] = $seriesDataTCV;
        $data['seriesDataACV'] = $seriesDataACV;
        $data['perStart'] = round($perStart,'2');
        $data['perResponse'] = round($perResponse,'2');
        $data['perComRate'] = round($perComRate,'2');
        $data['pernumCarts'] = round($pernumCarts,'2');
        $data['perTotalAmount'] = round($perTotalAmount,'2');
        $data['perAvgAmount'] = round($perAvgAmount,'2');
        $data['tStarts'] = max($tStarts,$tStartsold);
        $data['tResponses'] = max($tResponses,$tResponsesold);
        $data['tComRate'] = max($tComRate,$tComRateold);
        $data['tnumCart'] = max($tnumCart,$tnumCartold);
        $data['tTCV'] = max($tTCV,$tTCVold);
        $data['tACV'] = max($tACV,$tACVold);
        echo json_encode($data);exit();
    }

    public function getResponse(){
        //print_r($_POST);die;
        $date = "'".$_POST['date']."'";
        $responseData = DB::select("SELECT * from tbl_quizInfo where quiz_id = ".$_POST['quizId']." and created_at = ".$date);
        $quizData = DB::select('SELECT * from quiz where id = '.$_POST['quizId']);
       $new_date = '';
        if(!empty($responseData)) { 
            for($i=0;$i<1;$i++){
                $frame = '';
                $allframeArr = explode(",",$responseData[$i]->frame);
                for($j=0;$j<count($allframeArr);$j++){
                     $frameArr = DB::select('SELECT * from mirrormates where id = '.$allframeArr[$j]);
                     $frame.=$frameArr[0]->frame.', ';
                } 
            }

            $colorArr = array();
            $colorArr = explode(",",$responseData[0]->color);
            $old_date_timestamp = strtotime($responseData[0]->created_at);
            $new_date = date('M d, Y  H:i', $old_date_timestamp);
            $cStr = '';
            if(!empty($colorArr)) { 
                for($j=0;$j<count($colorArr);$j++){ 
                    $color = array();
                    $color = DB::select('SELECT * from colors where id = '.$colorArr[$j]);
        			$strr =  'You Chose '.$color[0]->frame;
                    $cStr.="<div class='response-list clearfix'><span class='img-icon'><svg data-v-192c7a0b='' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='image' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' class='fa-fw svg-inline--fa fa-image fa-w-16'><path data-v-192c7a0b='' fill='currentColor' d='M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z' class=''></path></svg></span><p>".$strr."</p></div>";
                }       
            } 
        } 
      $str = "";
        if(!empty($responseData)){ 
        $str.="<div class='respon-title'>".$new_date.' - '.$quizData[0]->quiz_name."</div><div class='response-list clearfix'><span class='img-icon'><svg data-v-192c7a0b='' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='image' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' class='fa-fw svg-inline--fa fa-image fa-w-16'><path data-v-192c7a0b='' fill='currentColor' d='M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z' class=''></path></svg></span><p>Let's start with your style. Is it more... </p><span>".rtrim($frame,', ')."</span></div>".$cStr;
        echo json_encode($str);exit();
        }
    }
}
