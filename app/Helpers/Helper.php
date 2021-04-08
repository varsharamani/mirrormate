<?php
//use Session;

function responsedata(){

	

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
function collectionList(){
    $data =  Session::get('collectionData');
    if(empty($data)){
        $username='a7acdbe5d4d00f7537f7292aa226df09';
          $password = '69e8f92992dbb9056c994d882066aa6d';
         $baseUrl = 'https://mirrormatellc.myshopify.com/admin/';
            $url_custom = $baseUrl.'custom_collections/count.json';
            $url_smart = $baseUrl.'smart_collections/count.json';
            $total_CustomColl = __curl($url_custom,$username,$password);
            $total_SmartColl = __curl($url_smart,$username,$password);
           
            $count_c = $total_CustomColl->count/50;
            $count_s = $total_SmartColl->count/50;
           
            $responseArr_all_custom = array();
            for($i=1;$i<=ceil($count_c);$i++){
              $url = $baseUrl.'custom_collections.json?page='.$i;
               $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $response = curl_exec($ch);
                curl_close($ch);
                $responseArr = json_decode($response);
                array_push($responseArr_all_custom, $responseArr);
            }
            $responseArr_all_smart = array();
            for($k=1;$k<=ceil($count_s);$k++){
              $url = $baseUrl.'smart_collections.json?page='.$k;
               $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $response = curl_exec($ch);
                curl_close($ch);
                $responseArr = json_decode($response);
                array_push($responseArr_all_smart, $responseArr);
            }

            //echo "<PRE>";print_r($responseArr_all_smart);die;
            // ECHO count($responseArr_all);DIE;
            $resData_custom = array();
             for($j=0;$j<count($responseArr_all_custom);$j++){
                 for($k=0;$k<count($responseArr_all_custom[$j]->custom_collections);$k++){
                      array_push($resData_custom,$responseArr_all_custom[$j]->custom_collections[$k]);
                 }
              
             }

             $resData_smart = array();
             for($p=0;$p<count($responseArr_all_smart);$p++){
                 for($q=0;$q<count($responseArr_all_smart[$p]->smart_collections);$q++){
                      array_push($resData_smart,$responseArr_all_smart[$p]->smart_collections[$q]);
                 }
              
             }

             $resData = array();
             $resData = array_merge($resData_custom, $resData_smart);
           // echo "<PRE>";print_r($resData);die;
             $responseData = array();
            foreach ($resData as $key => $value) {
                        $responseData['id'][$key]=$value->id;
                        $responseData['response'][$key]=$value;   
            }

            $data = json_decode(json_encode($responseData), true);
            //echo "Hii";die;
           // echo "<PRE>";print_r($data);die;
           //echo count($resData);die;
            //return $data;
            Session::put('collectionData',$data);
            return $data;
        }else{
            return $data;
        }
  
    //echo "Hii";die;
   // print_r($data);die;
    

}
?>