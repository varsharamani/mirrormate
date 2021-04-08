<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

        <title>Laravel</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="fontawesome/css/all.min.css">
        <link rel="stylesheet" href="css/app-back.css">
    </head>     

    <main class="">
          <input type="hidden" id="home" value="{{URL('/quiz')}}">
          <input type="hidden" name="storeQuiz" id="storeQuiz" value="{{URL::to('storeQuiz')}}">
          <input type="hidden" name="editQuiz" id="editQuiz" value="{{ URL::to('editQuiz')}}">
          <input type="hidden" id="deleteQuiz" value="{{ URL::to('deleteQuiz')}}">
           <input type="hidden" id="publishQuiz" value="{{ URL::to('/publishQuiz')}}">
           <input type="hidden" id="publish" value="{{ URL::to('/publish')}}">
         

        <div class="quiz-dash">
            <?php $allQuiz = DB::select('select * from quiz');  
              for($i=0;$i<count($allQuiz);$i++){ 
            ?>
              <div class="dash-quiz" id="quiz<?php echo $allQuiz[$i]->id; ?>">
                <a href="{{ URL::to('quiz/'.$allQuiz[$i]->id)}}" style="color: black;">
                    <?php echo $allQuiz[$i]->quiz_name; ?>
                </a>
                 <div class="dropdown">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background-color: #62ded5; border-color: #62ded5;">
                    <i class="fas fa-ellipsis-h"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ URL::to('quiz/'.$allQuiz[$i]->id)}}" >Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="deleteQuiz(<?php echo $allQuiz[$i]->id; ?>)">Delete</a>
                    <a class="dropdown-item" href="{{ URL::to('publish/'.$allQuiz[$i]->id)}}" >Publish</a>
                     <a class="dropdown-item" href="{{ URL::to('matrix/'.$allQuiz[$i]->id)}}" >Metrics</a>
                  </div>
                </div> 
              </div>
          <?php } ?>
          <span class="dash-quiz new" data-toggle="modal" data-target="#myModal">
            <div class="aquiz-box" style="cursor: pointer;">
              <span>+</span>
              <span>add new quiz</span>
            </div>
          </span>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title" id="myModalLabel">New Quiz</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label>Quiz Name</label><br/>
                        <input type="text" name="quiz_name" id="quiz_name" class="el-input__inner" autocomplete="off">
                        <p id="msg" style="display: none;color: red;">Please enter quiz name</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addQuiz();">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</html>
<script src="{{ asset('js/jquery.min.js') }}"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> 

{{-- <script src="js/jquery-3.2.1.slim.min.js"></script> --}}
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/moment.min.js"></script>


<script type="text/javascript">
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  function addQuiz(){
    var url = $('#storeQuiz').val();
    var redirect  = $('#home').val();
    var qname = $('#quiz_name').val();

    if(qname == ''){
        $('#msg').show();
    }else if(qname != ''){
        $.ajax({
            url: url,
            type: "POST",
            dataType: "html",
            data: {
             _token: "{{ csrf_token() }}",
             qname:qname 
           },
           cache: false,
           success: function(data){  
            var redirect1 = redirect+'/'+data;
                window.location.href=redirect1;
                $('#msg').hide();
           }
         });
    }     
  }

 /* function editQuiz(id){
   
    var url = $('#editQuiz').val();
     var redirect  = $('#home').val()+'/'+id;
    $.ajax({
          url: url,
          type: "POST",
          dataType: "html",
          data: {
           _token: "{{ csrf_token() }}",
           quiz_id:id 
         },
         cache: false,
         success: function(data){  
              window.location.href=redirect;
         }
       });
  }

  

  function publishQuiz(id){
     var url = $('#publishQuiz').val();
     var redirect = $('#publish').val();
      $.ajax({
          url: url,
          type: "POST",
          dataType: "html",
          data: {
           _token: "{{ csrf_token() }}",
           quiz_id:id 
         },
         cache: false,
         success: function(data){ 
            window.location.href=redirect;
         }
       });
  }*/
function deleteQuiz(id){
   if(confirm('Are You Sure?')) {  
      var url = $('#deleteQuiz').val();
      var url1 = url+'/'+id;
      $.ajax({
          url: url1,
          type: "delete",
          dataType: "html",
          data: {
           _token: "{{ csrf_token() }}",
           quiz_id:id 
         },
         cache: false,
         success: function(data){ 
          alert('Quiz Delete Successfully');
         $('#quiz'+id).hide(); 
              //window.location.href=redirect;
         }
       });
    }
  }
  $(document).ready(function () {      
      $("#myBtn").click(function(){
           $('#myModal').modal('show');
      });
  });
</script>