@extends('theme.master')

@section('title',"Start Quiz")

@section('content')

<section id="quiz-nav-bar" class="quiz-nav-bar-block">
  <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="navbar-header">
              <!-- Branding Image -->
              
              @if($topic)
                <h4 class="heading">{{$topic->title}}</h4>
              
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li></li>               
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
 <section class="quiz-main-block quiz-main-block-two">
   <div class="container">

   
  

    @if (Auth::check())
      <div class="">
        <?php 
        $users =  App\QuizAnswer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->first();
        $que =  App\Quiz::where('topic_id',$topic->id)->get();
         $que_count =  App\Quiz::where('topic_id',$topic->id)->count();
        ?>

        @if($que->isEmpty())
        <div class="alert alert-danger">
                No Questions in this quiz
        </div>

        @else

      

         @if(!empty($users))
            <div class="alert alert-danger">
                You have already Given the test ! Try to give other Quizes
            </div>
         @else
        <div id="question_block" class="question-block">
          <div class="question"  id="question-div" >
           
       <form action="{{route('start.quiz.store',$topic->id) }}" method="POST" id="question-form">
            {{ csrf_field() }}
                <?php 
                  $count=1;
                  
                 ?>
                <div id="more_quiz0">
                 <span id="quizNumber">{{$count}}</span><span>/{{$que_count}}</span>
                <div class="jumbotron" id="quiz1" >
                  <h4 style="color:black;">Q{{$count}}.&emsp;{{ $que[0]['question'] }}</h4>
                  <input type="hidden" id="question_id[{{$count}}]" name="question_id[{{$count}}]" value="{{ $que[0]['id'] }}">
                  <input type="hidden" id="canswer[{{$count}}]" name="canswer[{{$count}}]" value="{{ $que[0]['answer'] }}">
                  <label class="radio">
                     <input type="radio" required name="answer[{{$count}}]" value="A">{{ $que[0]['a'] }}
                  </label>
                  <label class="radio">
                     <input type="radio" required name="answer[{{$count}}]" value="B">{{ $que[0]['b'] }}
                  </label>
                  <label class="radio">
                     <input type="radio" required name="answer[{{$count}}]" value="C">{{ $que[0]['c'] }}
                  </label>
                  <label class="radio">
                     <input type="radio" required name="answer[{{$count}}]" value="D">{{ $que[0]['d'] }}
                  </label>
                   <br>
                 </div> 
               </div>

              @foreach($que as $key => $equestion)

              @if($key>0)
               <div style="display: none;" id="more_quiz{{ $key }}">
                <div>
               <span id="quizNumber">{{$count}}</span><span>/{{$que_count}}</span>
             </div>
                <div class="jumbotron" id="quiz{{ $key+1 }}" >
                  <h4 style="color:black;">Q{{$count}}.&emsp;{{ $equestion['question'] }}</h4>
                  <input type="hidden" id="question_id[{{$count}}]" name="question_id[{{$count}}]" value="{{ $equestion['id'] }}">
                  <input type="hidden" id="canswer[{{$count}}]" name="canswer[{{$count}}]" value="{{ $equestion['answer'] }}">
                  <label class="radio">
                     <input type="radio" required name="answer[{{$count}}]" value="A">{{ $equestion['a'] }}
                  </label>
                  <label class="radio">
                     <input type="radio" required name="answer[{{$count}}]" value="B">{{ $equestion['b'] }}
                  </label>
                  <label class="radio">
                     <input type="radio" required name="answer[{{$count}}]" value="C">{{ $equestion['c'] }}
                  </label>
                  <label class="radio">
                     <input type="radio" required name="answer[{{$count}}]" value="D">{{ $equestion['d'] }}
                  </label>
                   <br>
                 </div>
                 </div>
                 @endif
                    <?php $count++; ?>

                
             @endforeach
             
              <button style="display: none;" id="prev" title="Click to see previous question" class="btn btn-md btn-primary" value="1"><< {{ __('frontstaticword.Prev') }}</button>
              @if($que_count>1)
              <button title="Click to see next question" id="next" class="pull-right btn btn-md btn-primary" value="0">{{ __('frontstaticword.Next') }} >></button>
              @else
              <button title="Finish the quiz" type="submit" class="btn btn-md btn-primary">{{ __('frontstaticword.Finish') }}</button>
              @endif
              
         </form>
          
     </div>
        </div>
        @endif
        
        @endif
      </div>
    @endif
  </div>
  
</section>
  <!-- jQuery 3 -->

@endsection

@section('custom-script')
  <script type="text/javascript">

    var totalques = 0;

    
    $(document).ready(function(){
        
         totalques = $('.jumbotron').length;

    });

     
    
     var i =1;

     $('#next').click(function(){

      var x = $('#next').val();
      var y = $('#prev').val();
      
      i++;

        $('#prev').show();

        x++ ;
        if(x<totalques){

          $('#more_quiz'+x).show('fast');
          var z = x-1;
          $('#more_quiz'+z).hide('fast');

          $('#next').val(x);
          $('#prev').val(x);

          if(i== totalques){
            $('#next').attr('type','submit');
            $('#next').text('Finish');
          }
          

        }else{
          
          //code
         
        }
          
          
    });

     $('#prev').click(function(){

      i--;

      var x = $('#next').val();
      var y = $('#prev').val();

      $('#next').removeAttr('type');
      $('#next').text('Next >>');


        $('#next').show();

        y--;
        
        if(y==0){
          $('#next').val(0);
          $('#prev').val(1);
          $('#prev').hide();
        }else{
          $('#next').val(y);
          $('#prev').val(y);
        }

        $('#more_quiz'+y).show('fast');
        $('#more_quiz'+x).hide();
                
          
    });


  </script>


@endsection
