<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
    <title>Product Recommendation Quiz</title>
    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-back.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> 

</head>
<body>
     <?php if(!empty($data)){
        $id =  $data[0]->id ;
      }
      else{
        $id = 0;
      }
      ?>
    <input type="hidden" id="quizId" value="<?php echo $quizId; ?>">
     <input type="hidden" id="matrixFilter" value="{{URL::to('matrixFilter')}}">
     <input type="hidden" id="sdate" value="<?php echo $startDate; ?>">
     <input type="hidden" id="edate" value="<?php echo $endDate; ?>">
     <input type="hidden" id="getResponse" value="{{URL::to('getResponse')}}">
    <main class="">
        <div class="app-wrapper matrix-filter">
            <div class="main-container">
                <div class="topbar">
                    <div class="t-navbar">
                        <div class="breadcrumbs">
                             <a href="{{URL('/')}}" class="back-link"> Dashboard</a> 
                            <span class="current-title"> / {{ $quizData[0]->quiz_name }}</span>
                        </div>
                        <div class="right-menu">
                            <a href="https://www.mirrormate.com/#mmquiz-<?php echo base64_encode($quizId); ?>" class="btn btn-sm btn-themec btn-preview" target="_blank"> <i class="fas fa-eye"></i> Preview Quiz</a>
                        </div>
                        <div class="topnav-wrap">
                            <ul class="navbar-wrap">
                                <li class="nav-item">
                                    <a class="nav-link <?php if(Request::url() == url('/quiz/'.$quizId)) { echo 'active'; } ?>" href="{{ url('/quiz/'.$quizId) }}" >Back to Home</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link <?php if(Request::url() == url('/publish/'.$quizId)) { echo 'active'; } ?>" href="{{ url('/publish/'.$quizId) }}" >Publish</a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
                <section class="app-apart">
                    <div class="app-position">
                        <div class="app-builder aap-second">
                            <div class="ab-wrap publish-container">
                                <div class="app-row row mt-5">
                                    <div class="col-4">
                                        <div class="builder-logic- matrix-tab">
                                            <div class="padd20">
                                                <div class="publish-tab"> 
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="analytics-tab" data-toggle="tab" href="#analytics" role="tab" aria-controls="analytics" aria-selected="true" onclick="showContent(1);"><span>Analytics</span></a>
                                                        </li>
                                                       <li class="nav-item">
                                                            <a class="nav-link" id="responses-tab" data-toggle="tab" href="#responses" role="tab" aria-controls="responses" aria-selected="false" onclick="showContent(2);"><span>Responses</span></a>
                                                        </li> 
                                                       <!--  <li class="nav-item">
                                                            <a class="nav-link" id="inline-tab" data-toggle="tab" href="#inline" role="tab" aria-controls="inline" aria-selected="false"><span>Inline</span></a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="automatic-tab" data-toggle="tab" href="#automatic" role="tab" aria-controls="automatic" aria-selected="false"><span>Automatic</span></a>
                                                        </li> -->
                                                    </ul>

                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
                                                            <div class="pt-content ">
                                                                <div class="clearfix matrix-tab-scroll ">
                                                                    <p>Check out your quiz's performance during a particular period of time</p>
                                                                    <div class="metrics-box box-sm box-shadow">
                                                                        <p>Starts</p>
                                                                        <h2 id="Start"></h2> 
                                                                        <p class="var" id="perStart"><!---->0 %</p>
                                                                    </div>
                                                                    <div class="metrics-box box-sm box-shadow fright">
                                                                        <p>Responses</p>
                                                                        <h2 id="finish"></h2> 
                                                                        <p class="var" id="perResponse"><!---->0 %</p>
                                                                    </div>
                                                                    <div class="metrics-box box-sm box-shadow">
                                                                        <p>Comp. Rate</p>
                                                                        <h2 id="comRate"></h2> 
                                                                        <p class="var" id="perComRate"><!---->0 %</p>
                                                                    </div>
                                                                    <div class="metrics-box box-sm box-shadow fright">
                                                                        <p>Num Carts</p>
                                                                        <h2 id="numCarts"></h2> 
                                                                        <p class="var" id="pernumCarts"><!---->0 %</p>
                                                                    </div>
                                                                    <div class="metrics-box box-sm box-shadow">
                                                                        <p>Tot. Carts Val.</p>
                                                                        <h2 id="numCartsSum"></h2> 
                                                                        <span> USD</span>
                                                                        <p class="var" id="perTotalAmount"><!---->0 %</p>
                                                                    </div>
                                                                    <div class="metrics-box box-sm box-shadow fright">
                                                                        <p >Avg. Cart Val.</p>
                                                                        <h2 id="numCartsAvg"></h2> 
                                                                        <span> USD</span>
                                                                        <p class="var" id="perAvgAmount"><!---->0 %</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade show active" id="responses" role="tabpanel" aria-labelledby="responses-tab" style="display: none;">
                                                            <div class="pt-content ">
                                                                <div class="clearfix matrix-tab-scroll ">
                                                                    <p>Click on any of the responses to see what each customer has answered </p>
                                                                    <?php if(!empty($responseData)){
                                                                        for($i=0;$i<count($responseData);$i++){
                                                                            $new_date = '';
                                                                            $old_date_timestamp = strtotime($responseData[$i]->created_at);
                                                                             $new_date = date('M d, Y  H:i',$old_date_timestamp); 
                                                                            ?>
                                                                           
                                                                            <input type="checkbox" value="<?php echo $responseData[$i]->created_at; ?>" name="checkbox"> <?php echo $new_date; ?><br/>
                                                                            <?php
                                                                        }
                                                                    } 
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-8">
                                        <div class="padd20" id="analytics1">
                                            <div class="date--chart" id="link1">
                                                <div class="dc-for">
                                                    <input type="text" name="daterange" id="daterange" onchange="myFunction()" />
                                                </div>
                                            </div>
                                            <figure class="highcharts-figure">
                                                <div id="startChart"></div>
                                            </figure>
                                             <figure class="highcharts-figure">
                                                <div id="responseChart"></div>
                                            </figure>
                                            <figure class="highcharts-figure">
                                                <div id="comRateChart"></div>
                                            </figure>
                                             <figure class="highcharts-figure">
                                                <div id="numofCartChart"></div>
                                            </figure> 
                                            <figure class="highcharts-figure">
                                                <div id="TotalCartsValueChart"></div>
                                            </figure>
                                            <figure class="highcharts-figure">
                                                <div id="AvgCartValueChart"></div>
                                            </figure>
                                           
                                        </div>

                                        <div class="bg-white" id="responses1" style="display: none;">
                                           <div class="air-preview box-shadow bg-white padd20" id="response">
                                                <?php $new_date = ''; if(!empty($responseData)) { for($i=0;$i<1;$i++){
                                                    $frame = '';
                                                    $allframeArr = explode(",",$responseData[$i]->frame);
                                                    for($j=0;$j<count($allframeArr);$j++){
                                                         $frameArr = DB::select('SELECT * from mirrormates where id = '.$allframeArr[$j]);
                                                         $frame.=$frameArr[0]->frame.', ';

                                                    } }

                                                    $colorArr = array();
                                                    $colorArr = explode(",",$responseData[0]->color);

                                                    
                                                        $old_date_timestamp = strtotime($responseData[0]->created_at);
                                                        $new_date = date('M d, Y  H:i', $old_date_timestamp);  
                                                    
                                                    
                                                } 
                                                ?>
                                                <?php if(!empty($responseData)){ ?>
                                                <div class="respon-title">
                                                    <?php echo $new_date.' - '.$quizData[0]->quiz_name; ?>
                                                </div>
                                                
                                                <div class="response-list clearfix">
                                                    <span class="img-icon"><svg data-v-192c7a0b="" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="image" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fa-fw svg-inline--fa fa-image fa-w-16"><path data-v-192c7a0b="" fill="currentColor" d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z" class=""></path></svg></span>
                                                    <p>Let's start with your style. Is it more... </p>
                                                    <span><?php if(isset($frame)) echo rtrim($frame,', '); ?></span>
                                                </div>
                                                <?php if(!empty($colorArr)) { for($j=0;$j<count($colorArr);$j++){ 
                                                    $color = array();
                                                     $color = DB::select('SELECT * from colors where id = '.$colorArr[$j]);
                                                ?>
                                                    <div class="response-list clearfix">
                                                        <span class="img-icon"><svg data-v-192c7a0b="" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="image" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fa-fw svg-inline--fa fa-image fa-w-16"><path data-v-192c7a0b="" fill="currentColor" d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z" class=""></path></svg></span>
                                                        <p>You Chose <?php echo $color[0]->frame; ?></p>
                                                    </div>
                                                <?php } } } ?>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <input type="hidden" id="start" value="<?php echo $new_chart_data; ?>">
        <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>

        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- <script src="fontawesome/js/all.min.js"></script> -->
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> 
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

</body>

<script type="text/javascript">
$("input[name='checkbox']").change(function() {
    var url1 = $('#getResponse').val();
    $('input[name="checkbox"]').prop('checked',false);
    $(this).prop('checked',true);
      if ($(this).is(':checked')) { 
         $.ajax({
            url: url1,
            type: "POST",
            dataType: "json",
            data: {
             _token: "{{ csrf_token() }}",
             date : $(this).val(),
             quizId : $('#quizId').val()

           },
           cache: false,
           success: function(data){ 
            // window.top.location = jQuery('#nexturl').val();
           // alert(data);
            $('#response').html('');
            $('#response').append(data);
           }
         });
      }
});
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(function() {
    var d1 = $('#sdate').val();
    $('input[name="daterange"]').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    },
    opens: 'left',
    startDate: d1,
    endDate: new Date(),
    maxDate: new Date()
  }, function(start, end, label) {
  });
});

function showContent(type){
    if(type == 1){
        $('#analytics1').css('display','block');
        $('#responses1').css('display','none');
        $('#responses').css('display','none');
    }else if(type == 2){
        $('#analytics1').css('display','none');
        $('#responses1').css('display','block');
        $('#responses').css('display','block');
    }
}
function myFunction(){
    var quizId = $('#quizId').val();
    var url1 = $('#matrixFilter').val()+'/'+quizId;
    var date = $('#daterange').val();
    var dateArr = date.split(' - ');
    $('#sdate').val(dateArr[0]);
     $('#edate').val(dateArr[1]);
     $.ajax({
        url: url1,
        type: "POST",
        dataType: "Json",
        data: { 
         _token: "{{ csrf_token() }}",
         date:date
       },
       cache: false,
       success: function(data){ 
        $('#Start').text('');
        $('#finish').text('');
        $('#numCarts').text('');
        $('#numCartsSum').text('');
        $('#numCartsAvg').text('');
        $('#comRate').text('');
        
        if(data.Start == 'NaN'){
            $('#Start').text(data.Start);
        }else{
            $('#Start').text(data.Start+' K');
        }

        if(data.finish == 'NaN'){
            $('#finish').text(data.finish);
        }else{
            $('#finish').text(data.finish+' K');
        }
        
        //$('#finish').text(data.finish);
        $('#numCarts').text(data.numCarts);
        $('#numCartsSum').text(data.numCartsSum);
        $('#numCartsAvg').text(data.numCartsAvg);
        $('#comRate').text(data.comRate+' %');

        if (data.perStart > 0) {
            $('#perStart').text(data.perStart+' %');
            $('#perStart').addClass('positive');
        }else{
            $('#perStart').addClass('negative');
        }
        if (data.perResponse > 0) {
            $('#perResponse').text(data.perResponse+' %');
            $('#perResponse').addClass('positive');
        }else{
            $('#perResponse').addClass('negative');
        }
        if (data.perComRate > 0) {
            $('#perComRate').text(data.perComRate+' %');
            $('#perComRate').addClass('positive');
        }else{
            $('#perComRate').addClass('negative');
        }
        if (data.pernumCarts > 0) {
            $('#pernumCarts').text(data.pernumCarts+' %');
            $('#pernumCarts').addClass('positive');
        }else{
            $('#pernumCarts').addClass('negative');
        }
        if (data.perTotalAmount > 0) {
            $('#perTotalAmount').text(data.perTotalAmount+' %');
            $('#perTotalAmount').addClass('positive');
        }else{
            $('#perTotalAmount').addClass('negative');
        }
        if (data.perComRate > 0) {
            $('#perAvgAmount').text(data.perAvgAmount+' %');
            $('#perAvgAmount').addClass('positive');
        }else{
            $('#perAvgAmount').addClass('negative');
        }
        
    
        /*$('#pernumCarts').text(data.pernumCarts+' %');
        $('#perTotalAmount').text(data.perTotalAmount+' %');
        $('#perAvgAmount').text(data.perAvgAmount+' %');*/
        startsChart(data.seriesDataS,data.seriesDataR,data.seriesDataCR,data.seriesDataNC,data.seriesDataTCV,data.seriesDataACV,data.tStarts,data.tResponses,data.tComRate,data.tnumCart,data.tTCV,data.tACV);
       },
       error: function() {
            alert('ajax call failed...');
        }
     });             
}
</script>
<script type="text/javascript">
function startsChart(dataS,dataR,dataCR,dataNC,dataTCV,dataACV,max1,max2,max3,max4,max5,max6){
    alert(dataS);
    var sdate = $('#sdate').val();
    var sdateArr = sdate.split("-");

    var edate = $('#edate').val();
    var edateArr = edate.split("-");
    console.log(sdateArr);
    var startDate = new Date(sdate);
    makeDate = new Date(startDate.setMonth(startDate.getMonth() - 1));
    var prevM = makeDate.getMonth()+1;

     var endDate = new Date(edate);
    makeDateE = new Date(endDate.setMonth(endDate.getMonth()));
    var prevME = makeDateE.getMonth();

    if(prevM == 12){
      sdateArr[0] = sdateArr[0]-1;
    }
    if(prevME == 12){
      edateArr[0] = edateArr[0]-1;
    }

    var dateE = new Date(edate);
    var day = dateE.getDay();   
      /*alert(sdateArr[2]);
      alert(prevM);
      alert(sdateArr[0]);

      alert(edateArr[2]);
      alert(prevME);
      alert(edateArr[0]);*/
        // alert(sdateArr[0]);
        // var aa = $('#start').val();
        //alert(aa+'ci');
        console.log(sdateArr[0], prevM, sdateArr[2]);
        console.log(edateArr[0], prevME,edateArr[2]);
    $('#startChart').highcharts({
        chart: {
          type: 'spline'
        },
        tooltip: {
            shared: true,
            split: false,
            enabled: true
        },
        title: {
          text: 'Number of Starts',
          align:'left'
        },
        subtitle: {
          text: ' '
        },
        xAxis: {
          type: 'datetime',
          labels: {
              format: '{value:%e %b }'
          },
          startOfWeek:day,
          startOnTick: true,
          min: Date.UTC(sdateArr[0], prevM, sdateArr[2]),
          max: Date.UTC(edateArr[0], prevME,edateArr[2]),
          tickInterval: 7 * 24 * 3600 * 1000 // interval of 1 day
        },
       yAxis: {
            title: {
                text: ' '
            },
            min:0,
            max:max1
        },
        credits: {
            enabled: false
        },
        exporting: { 
            enabled: false 
        },
        colors: ['#1E90FF', '#FF8C00','#FF8C00'],
        series: eval(dataS) 
    });

    $('#responseChart').highcharts({
        chart: {
          type: 'spline'
        },
        tooltip: {
            shared: true,
            split: false,
            enabled: true
        },
        title: {
          text: 'Number of Responses',
          align:'left'
        },
        subtitle: {
          text: ' '
        },
        xAxis: {
          type: 'datetime',
          labels: {
              format: '{value:%e %b }'
          },
          startOfWeek:day,
          startOnTick: true,
         min: Date.UTC(sdateArr[0], prevM, sdateArr[2]),
          max: Date.UTC(edateArr[0], prevME,edateArr[2]),
          tickInterval: 7 * 24 * 3600 * 1000 // interval of 1 day
        },
       yAxis: {
            min: 0,
            max:max2,
            title: {
                text: ' '
            }

        },
        credits: {
            enabled: false
        },
        exporting: { 
            enabled: false 
        },
        colors: ['#1E90FF', '#FF8C00','#FF8C00'],
        series: eval(dataR) 
    });

    $('#comRateChart').highcharts({
        chart: {
          type: 'spline'
        },
        tooltip: {
            shared: true,
            split: false,
            enabled: true
        },
        title: {
          text: 'Completion Rate',
          align:'left'
        },
        subtitle: {
          text: ' '
        },
        xAxis: {
          type: 'datetime',
          labels: {
              format: '{value:%e %b }'
          },
          startOfWeek:day,
          startOnTick: true,
          min: Date.UTC(sdateArr[0], prevM, sdateArr[2]),
          max: Date.UTC(edateArr[0], prevME,edateArr[2]),
          tickInterval: 7 * 24 * 3600 * 1000 // interval of 1 day
        },
        yAxis: {
            title: {
                text: ' '
            },
            labels: {
                  format: '{value}%',
            },
            min:0,
            max:max3
        },
        credits: {
            enabled: false
        },
        exporting: { 
            enabled: false 
        },
        colors: ['#1E90FF', '#FF8C00','#FF8C00'],
        series: eval(dataCR) 
    });

    $('#numofCartChart').highcharts({
        chart: {
          type: 'spline'
        },
        tooltip: {
            shared: true,
            split: false,
            enabled: true
        },
        title: {
          text: 'Number of Carts',
          align:'left'
        },
        subtitle: {
          text: ' '
        },
        xAxis: {
          type: 'datetime',
          labels: {
              format: '{value:%e %b }'
          },
          startOfWeek:day,
          startOnTick: true,
         min: Date.UTC(sdateArr[0], prevM, sdateArr[2]),
          max: Date.UTC(edateArr[0], prevME,edateArr[2]),
          tickInterval: 7 * 24 * 3600 * 1000 // interval of 1 day
        },
       yAxis: {
            title: {
                text: ' '
            },
            min:0,
            max:max4
        },
        credits: {
            enabled: false
        },
        exporting: { 
            enabled: false 
        },
        colors: ['#1E90FF', '#FF8C00','#FF8C00'],
        series: eval(dataNC) 
    });

    
    $('#TotalCartsValueChart').highcharts({
        chart: {
          type: 'spline'
        },
        tooltip: {
            shared: true,
            split: false,
            enabled: true
        },
        title: {
          text: 'Total Carts Value',
          align:'left'
        },
        subtitle: {
          text: ' '
        },
        xAxis: {
          type: 'datetime',
          labels: {
              format: '{value:%e %b }'
          },
          startOfWeek:day,
          startOnTick: true,
          min: Date.UTC(sdateArr[0], prevM, sdateArr[2]),
          max: Date.UTC(edateArr[0], prevME,edateArr[2]),
          tickInterval: 7 * 24 * 3600 * 1000 // interval of 1 day
        },
        yAxis: {
            title: {
                text: ' '
            },
            labels: {
                  format: '{value} USD',
            },
            min:0,
            max:max5
        },
        credits: {
            enabled: false
        },
        exporting: { 
            enabled: false 
        },
        colors: ['#1E90FF', '#FF8C00','#FF8C00'],
        series: eval(dataTCV) 
    });

    $('#AvgCartValueChart').highcharts({
        chart: {
          type: 'spline'
        },
        tooltip: {
            shared: true,
            split: false,
            enabled: true
        },
        title: {
          text: 'Avg. Cart Value',
          align:'left'
        },
        subtitle: {
          text: ' '
        },
        xAxis: {
          type: 'datetime',
          labels: {
              format: '{value:%e %b }'
          },
          startOfWeek:day,
          startOnTick: true,
          min: Date.UTC(sdateArr[0], prevM, sdateArr[2]),
          max: Date.UTC(edateArr[0], prevME,edateArr[2]),
          tickInterval: 7 * 24 * 3600 * 1000 // interval of 1 day
        },
        yAxis: {
            title: {
                text: ' '
            },
            labels: {
                  format: '{value} USD',
            },
            min:0,
            max:max6
        },
        credits: {
            enabled: false
        },
        exporting: { 
            enabled: false 
        },
        colors: ['#1E90FF', '#FF8C00','#FF8C00'],
        series: eval(dataACV) 
    });
}

</script>
</html>