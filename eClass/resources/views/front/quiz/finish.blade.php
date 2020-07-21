@extends('theme.master')
@section('title',"Show Report")
@section('content')
 <section class="main-wrapper finish-main-block">
   <div class="container">
    <br/>
  @if ($auth)
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="">
          <div class="question-block">
           

          @if($topics->show_ans==1)
        
          <div class="question-block">
            <h3 class="text-center main-block-heading">{{ __('frontstaticword.answerreoprt') }}</h3>
            <br/>
            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>{{ __('frontstaticword.Question') }}</th> 
                  <th style="color: red;">{{ __('frontstaticword.YourAnswer') }}</th>
                  <th style="color: #48A3C6;">{{ __('frontstaticword.CorrectAnswer') }}</th>
                </tr>
              </thead>
              <tbody>
                
                @php
                $x = $count_questions;               
                $y = 1;
                @endphp
                @foreach($ans as $key=> $a)
                    <tr>
                      <td>{{ $a->quiz->question }}</td>
                       <td>{{ $a->user_answer }}</td>
                      <td>{{ $a->answer }}</td>
                     
                    
                    </tr>
                    @php                
                      $y++;
                      if($y > $x){                 
                        break;
                      }
                    @endphp
                 
                @endforeach              
               
              </tbody>
            </table>
            
          </div>

          @endif

           <h3 class="text-center main-block-heading">{{ __('frontstaticword.scorecard') }} </h3>
            <br/>

            <table class="table table-bordered result-table">
              <thead>
                <tr>
                  <th>{{ __('frontstaticword.TotalQuestion') }}</th>
                  <th>{{ __('frontstaticword.CorrectQuestions') }}</th>
                  <th>{{ __('frontstaticword.PerQuestionMark') }}</th>
                  <th>{{ __('frontstaticword.TotalMarks') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$count_questions}}</td>
                  <td>
                    @php
                      $mark = 0;
                      $ca=0;
                      $correct = collect();
                    @endphp
                    @foreach ($ans as $answer)
                      @if ($answer->answer == $answer->user_answer)
                      
                        @php
                          $mark++;
                          $ca++;
                        @endphp
                      @endif
                    @endforeach
                    {{$ca}}
                  </td>
                  <td>{{$topics->per_q_mark}}</td>
                    @php
                        $correct = $mark*$topics->per_q_mark;
                    @endphp
                  <td>{{$correct}}</td>
                </tr>
              </tbody>
            </table>
           
            <br/>
            <h2 class="text-center">{{ __('frontstaticword.ThankYou') }}</h2>
            <div class="finish-btn text-center">
              @if($topics->quiz_again == '1')
              <a href="{{route('tryagain',$topics->id)}}" class="btn btn-primary">{{ __('frontstaticword.TryAgain') }} </a>
              @endif
              <a href="{{url('show/coursecontent',$topics->course_id)}}" class="btn btn-secondary">{{ __('frontstaticword.Back') }} </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
</section>
<br/>
@endsection

