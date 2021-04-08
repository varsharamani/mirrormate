<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use App\basicInfo;
use DB;
use App\Http\Resources\basicInfo as BasicInfoResources;
use Session;

class QuizController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
        $this->username='a7acdbe5d4d00f7537f7292aa226df09';
        $this->password = '69e8f92992dbb9056c994d882066aa6d';
        ini_set('display_errors',1);
        error_reporting(E_ALL);
       

        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request,$quizId1)
    { 
         //echo $quizId1;die;

        $quizId = base64_decode($quizId1);
         $allQuiz = DB::select('select * from quiz');
         $allQuizId = array();
         for($i=0;$i<count($allQuiz);$i++){
            array_push($allQuizId, $allQuiz[$i]->id);
         }
        if(in_array($quizId, $allQuizId)){
            $basicInfo = DB::select('select * from basic_infos where quiz_id = '.$quizId);
            if(isset($basicInfo)){
                 echo view ('front-popup',['data' => $basicInfo,'quizId'=>$quizId1]);
            }
            else{
                $this->quizNotFound(); 
            }
        }
        else{
            $this->quizNotFound();
           
        }
       
    }

    public function quizNotFound(){
         echo view('front-404');
    }

    public function frameSelect(Request $request,$quizId1){
         $quizId = base64_decode($quizId1);
        DB::table('tbl_matrix')->insert([
            ['status' => 1,'quiz_id'=>$quizId],
        ]);
        
        $basicInfo = DB::select('select * from basic_infos where quiz_id = '.$quizId);
        $frames = DB::select('select * from mirrormates where quiz_id = '.$quizId.' order by sort');
        echo view ('front-quiz',['data' => $basicInfo,'frames'=>$frames,'quizId1'=>$quizId1]);
    }

    public function frameColor(Request $request,$Fid,$quizId1){
          $shopByColor = array('71190741058','157530652810','71266336834','71269548098','71266402370','71266500674','71266205762','71269613634');
        $shopByPrice = array('71471562818','71471595586','71471628354');
        $shopByDecor = array('184624742538','184625266826','184626053258','184624316554','184625627274','71551516738','71551418434','71551483970');
        $shopByFWidth = array('73781510210','73782427714','73782493250');
        $shopByFName = array('71471857730','71546011714','71546044482','71546077250','71546470466','71546536002','71546601538','71546634306','71546699842','71547387970','71546798146','71546830914','71546896450','71546961986','71546994754','156904947850','71547027522','71547060290','71547093058','71547125826','71547191362','71547224130','71547256898','71547289666','71547322434','71547355202');

         $quizId = base64_decode($quizId1);
         $fArr = explode (",", $Fid);  
         //print_r($fArr);die;
        $basicInfo = DB::select('select * from basic_infos  where quiz_id = '.$quizId);
        $selectcolor = array();
        $mirrormates = array();
        $selectcolorAllID = array();
         for($i=0;$i<count($fArr);$i++){
            $sColor = DB::select('select * from colors where select_frame_id='.$fArr[$i].' order by sort');
            for($k=0;$k<count($sColor);$k++){
                if(!in_array($sColor[$k]->frame_id, $selectcolorAllID)){
                 array_push($selectcolor,$sColor[$k]);
                 array_push($selectcolorAllID,$sColor[$k]->frame_id);
                }
            }
           
            $choose1 = DB::select('select * from mirrormates where id='.$fArr[$i].' order by sort');
            array_push($mirrormates, $choose1[0]);
        }
        
         $str = '';
          $url = 'https://www.mirrormate.com/collections/all-frames?';
        $shopByColor1 = array();
        $shopByPrice1 = array();
        $shopByDecor1 = array();
        $shopByFWidth1 = array();
        $shopByFName1 = array();
        $whereC = $whereP = $whereD = $whereFW = $whereFN = $where ='';
        for($j=0;$j<count($mirrormates);$j++){
            if(in_array($mirrormates[$j]->frame_id, $shopByColor)){
                if($whereC == ''){
                    $whereC.='gf_277393='.$mirrormates[$j]->frame_id;
                }else{
                    $whereC.='%2B'.$mirrormates[$j]->frame_id;
                }
                
            }
            else if(in_array($mirrormates[$j]->frame_id, $shopByPrice)){
                if($whereP == ''){
                    $whereP.='gf_277394='.$mirrormates[$j]->frame_id;
                }else{
                    $whereP.='%2B'.$mirrormates[$j]->frame_id;
                }
            }
            else if(in_array($mirrormates[$j]->frame_id, $shopByDecor)){
               if($whereD == ''){
                    $whereD.='gf_277395='.$mirrormates[$j]->frame_id;
                }else{
                    $whereD.='%2B'.$mirrormates[$j]->frame_id;
                }
            }
            else if(in_array($mirrormates[$j]->frame_id, $shopByFWidth)){
               if($whereFW == ''){
                    $whereFW.='gf_277396='.$mirrormates[$j]->frame_id;
                }else{
                    $whereFW.='%2B'.$mirrormates[$j]->frame_id;
                }
            }
            else if(in_array($mirrormates[$j]->frame_id, $shopByFName)){
               if($whereFN == ''){
                    $whereFN.='gf_277397='.$mirrormates[$j]->frame_id;
                }else{
                    $whereFN.='%2B'.$mirrormates[$j]->frame_id;
                }
            }
            //echo $mirrormates[$j]->choose;die;
            $str.=$mirrormates[$j]->choose.' and ';
        }
        
            if($whereC != ''){
                if($where == ''){
                  $where.=$whereC;
                }else{
                  $where.='&'.$whereC;
                }
             }
            if($whereP != ''){
                if($where == ''){
                  $where.=$whereP;
                }else{
                  $where.='&'.$whereP;
                }
            }
           if($whereD != ''){
              if($where == ''){
                $where.=$whereD;
              }else{
                $where.='&'.$whereD;
              }
           }
           if($whereFW != ''){
              if($where == ''){
                $where.=$whereFW;
              }else{
                $where.='&'.$whereFW;
              }
           }
           if($whereFN != ''){
              if($where == ''){
                $where.=$whereFN;
              }else{
                $where.='&'.$whereFN;
              }
           }

           $finalUrl = $url.$where;
          // echo $str.'<br/>';
        //$choose = substr($str,0,'-4');
        $choose = 'You chose ';
        for($j=0;$j<count($mirrormates);$j++){
           
            
            $choose.=$mirrormates[$j]->frame.', ';
        }
       // echo $choose;die;
        echo view('front-color',['data' => $basicInfo,'selectcolor'=>$selectcolor,'choose'=>rtrim($choose,', '),'quizId'=>$quizId1,'Fid'=>$Fid,'finalUrl'=>$finalUrl,'whereC'=>$whereC,'whereP'=>$whereP,'whereD'=>$whereD,'whereFW'=>$whereFW,'whereFN'=>$whereFN]);
    }

     public function SelframeColor(Request $request,$colorid,$quizId1,$allframe){
            
          /*$quizId = base64_decode($quizId1);
        $basicInfo = DB::select('select * from basic_infos  where quiz_id = '.$quizId);
        $selectFramecolor = array();
        $mirrormates = array();
         $cArr = explode (",", $colorid);  

         for($i=0;$i<count($cArr);$i++){
           $selFramecolor = DB::select('select * from frame_cols where sel_color_id = '.$cArr[$i].' order by sort');
            for($k=0;$k<count($selFramecolor);$k++){
                 array_push($selectFramecolor,$selFramecolor[$k]);
            }
            $choose1 = DB::select('select * from colors where id='.$cArr[$i].' order by sort');
            array_push($mirrormates, $choose1[0]);
        }
        

        $str = 'You Choose ';
        for($j=0;$j<count($mirrormates);$j++){
            $choose1 =  str_replace("You Choose"," ",$mirrormates[$j]->choose);
             $choose2 =  str_replace(">","Of",$choose1); 
            $str.=$choose2.',';
        }
        $str = '';
        for($j=0;$j<count($mirrormates);$j++){
            $choose1 =  $mirrormates[$j]->choose;
             $choose2 =  str_replace(">","Of",$choose1); 
            $str.=$choose2.' and ';
        }
        $choose = rtrim($str,' and ');
        echo view('front-frame_color',['data' => $basicInfo,'selectFramecolor'=>$selectFramecolor,'mirrormates'=>$mirrormates,'choose'=>$choose,'allframe'=>$allframe,'quizId1'=>$quizId1]); */
    }
    public function finish_Quiz($quizId1,$type){
        //print_r($_POST);die;
       
        $quizId = base64_decode($quizId1);
        if($type == 2){
            DB::table('tbl_matrix')->insert([
                ['status' => 2,'quiz_id'=>$quizId],
            ]);
            DB::table('tbl_quizInfo')->insert([
                ['quiz_id' => $quizId,'frame' => $_POST['allFrame'],'color'=>$_POST['allColor']],
            ]);
        }else if($type == 3){
            $price = $_POST['price'];
            $fPrice = str_replace("$","",$price);
            DB::table('tbl_matrix')->insert([
                ['status' => 3,'quiz_id'=>$quizId,'price'=>$fPrice],
            ]);
        }
         
         echo "Hii";exit();
    }
}
?>