@extends('theme.master')
@section('title', 'Online Courses')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h4 class="wishlist-home-heading text-white"><i class="fa fa-home"></i>&nbsp;/&nbsp;{{ __('frontstaticword.Courses') }}</h4>
    </div>
</section> 
<!-- about-home end -->

<!-- search start -->
@if(count($courses) > 0)
    <section id="search-block" class="search-main-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    <div class ="prod grid-view">
                     <div class ="view">
                      <i class= "fa fa-list " data-view ="list-view"></i>
                      <i class="selected fa fa-th" data-view ="grid-view"></i>
                     </div>
                    
                    @foreach($courses as $course)

                    @if($course->status == 1)
                     
                    <div class="item first">
                      <div class="course-bought-section protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$course->id}}">

                        @if($course['preview_image'] !== NULL && $course['preview_image'] !== '')
                          <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img src ="{{ asset('images/course/'.$course->preview_image) }}" alt="" class="img-fluid"></a>
                        @else
                          <a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}"><img src="{{ Avatar::create($course->title)->toBase64() }}" alt="course" class="img-fluid"></a>
                        @endif

                       <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $course->id, 'slug' => $course->slug ]) }}">{{ str_limit($course->title, $limit = 30, $end = '...') }}</a></div>
                      
                       <div class="categories-popularity-dtl">
                            <ul>
                                <li>
                                    @php
                                        $data = App\CourseClass::where('course_id', $course->id)->get();
                                        if(count($data)>0){

                                            echo count($data);
                                        }
                                        else{

                                            echo "0";
                                        }
                                    @endphp {{ __('frontstaticword.Classes') }} 
                                </li>
                            </ul>
                            <p>{{  str_limit($course->short_detail, $limit = 60, $end = '..') }}</p>
                        </div>
                        <div class="rate-grid ">
                            <ul>
                                @php
                                    $currency = App\Currency::first();
                                @endphp 
                                @if($course->type == 1)
                                    @if($course->discount_price == !NULL)
                                        <li class="rate-r"><s><i class="{{ $currency->icon }}"></i>{{ $course->price }}</s>&nbsp;<i class="{{ $currency->icon }}"></i>{{ $course->discount_price }}</li>
                                    @else

                                        <li class="rate-r"><i class="{{ $currency->icon }}"></i>{{ $course->price }}</li>
                                    @endif

                                @else
                                    <li class="rate-r">{{ __('frontstaticword.Free') }}</li>
                                @endif
                            </ul>
                            <div class="rating">
                                <ul>
                                  <li>
                                    <?php 
                                    $learn = 0;
                                    $price = 0;
                                    $value = 0;
                                    $sub_total = 0;
                                    $sub_total = 0;
                                    $reviews = App\ReviewRating::where('course_id',$course->id)->where('status','1')->get();
                                    ?> 
                                    @if(!empty($reviews[0]))
                                    <?php
                                    $count =  App\ReviewRating::where('course_id',$course->id)->count();

                                    foreach($reviews as $review){
                                        $learn = $review->price*5;
                                        $price = $review->price*5;
                                        $value = $review->value*5;
                                        $sub_total = $sub_total + $learn + $price + $value;
                                    }

                                    $count = ($count*3) * 5;
                                    $rat = $sub_total/$count;
                                    $ratings_var = ($rat*100)/5;
                                    ?>
                    
                                    <div class="pull-left">
                                        <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
                                        </div>
                                    </div>
                               
                                     
                                    @else
                                        <div ><p>{{ __('frontstaticword.NoRating') }}</p></div>
                                    @endif
                                  </li>
                                    
                                  

                                </ul>
                            </div>
                            <ul>
                                <li>
                                    (@php
                                        $data = App\ReviewRating::where('course_id', $course->id)->get();
                                        if(count($data)>0){

                                            echo count($data);
                                        }
                                        else{

                                            echo "0";
                                        }
                                    @endphp ratings)
                                </li> 
                            </ul>
                        </div>

                        @if($course['whatlearns']->isNotEmpty())
                        <div id="prime-next-item-description-block{{$course->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                            <div class="prime-description-under-block">
                                <h6 >What you will learn</h6>
                                
                                @foreach($course['whatlearns'] as $wl)
                                @if($wl->status ==1)
                                    <div class="product-learn-dtl protip-whatlearn">
                                        <ul>
                                            <li><i class="fa fa-check"></i>{{ str_limit($wl['detail'], $limit = 120, $end = '...') }}</li>
                                        </ul>
                                    </div>
                                @endif
                                @endforeach
                                
                            </div>
                        </div>
                        </div>
                        @endif
                      </div>
                    </div>

                     
                    @endif

                    @endforeach
                     
                    </div>


                </div>
            </div>
        </div>
    </section>
@else
    <section id="search-block" class="search-main-block search-block-no-result">
        <div class="container">
          <h2>{{ __('frontstaticword.Nosearch') }} "{{$searchTerm}}"</h2>
        </div>
    </section>
@endif
<!-- search end -->

@endsection


@section('custom-script')
<script type="text/javascript">
      $('.item i').on('click', function(){
      $(this).toggleClass('fa-plus fa-minus').next().slideToggle()
    })
    /* list or grid item*/
    $(".view i").click(function(){

      $('.prod').removeClass('grid-view list-view').addClass($(this).data('view'));

    })
    $(".view i").click(function(){

      $(this).addClass('selected').siblings().removeClass('selected');

    })
</script>

@endsection



