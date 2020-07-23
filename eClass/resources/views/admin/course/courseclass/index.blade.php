<section class="content">
 
  <div class="row">
    <div class="col-md-12">
      <a data-toggle="modal" data-target="#myModalab" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
      <br>
      <br>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped db">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('adminstaticword.CourseChapter') }}</th>
              <th>{{ __('adminstaticword.Title') }}</th>
              <th>{{ __('adminstaticword.Status') }}</th>
              <th>{{ __('adminstaticword.Featured') }}</th>
              <th>{{ __('adminstaticword.Edit') }}</th>
              <th>{{ __('adminstaticword.Delete') }}</th>
            </tr>
          </thead>
          <tbody id="sortable">
            <?php $i=0;?>
            @foreach($courseclass as $cat)
              <tr class="sortable row1" data-id="{{ $cat->id }}">
                <?php $i++;?>
                <td><?php echo $i;?></td>
                @php
                $chname = App\CourseChapter::where('id','=',$cat->coursechapter_id)->get();
                @endphp
                <td>
                  @foreach($chname as $cc)
                  {{ $cc->chapter_name }}
                  @endforeach
                </td>
                <td>{{$cat->title}}</td>
                <td>
                  @if($cat->status==1)
                   {{ __('adminstaticword.Active') }}
                  @else
                   {{ __('adminstaticword.Deactive') }}
                  @endif
                </td>
                <td>
                  @if($cat->featured==1)
                    {{ __('adminstaticword.Yes') }}
                  @else
                    {{ __('adminstaticword.No') }}
                  @endif
                </td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{url('courseclass/'.$cat->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                </td> 
                <td>
                  <form  method="post" action="{{url('courseclass/'.$cat->id)}}"data-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!--Model start-->
  <div class="modal fade" id="myModalab" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">{{ __('adminstaticword.Add') }} {{ __('adminstaticword.CourseClass') }}</h4>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form enctype="multipart/form-data" id="demo-form2" method="post" action="{{ route('courseclass.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                          

                <select class="display-none" name="course_id" class="form-control">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.ChapterName') }}:<sup class="redstar">*</sup></label>
                    <select name="course_chapters" class="form-control col-md-7 col-xs-12 js-example-basic-single" required>
                      @foreach($coursechapters as $c)
                      <option value="{{ $c->id }}">{{ $c->chapter_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                    <input type="text" class="form-control " name="title" id="exampleInputTitle"   placeholder="Enter Your Title"value="" required>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:</label>
                    <textarea id="detail" name="detail" rows="1" class="form-control" placeholder="Enter class detail"></textarea>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="type">{{ __('adminstaticword.Type') }}:<sup class="redstar">*</sup></label>
                    <select name="type" id="filetype" class="form-control js-example-basic-single" required>
                      <option>{{ __('adminstaticword.ChooseFileType') }}</option>
                      <option value="video">{{ __('adminstaticword.Video') }}</option>
                      <option value="audio">{{ __('adminstaticword.Audio') }}</option>
                      <option value="image">{{ __('adminstaticword.Image') }}</option>
                      <option value="zip">{{ __('adminstaticword.Zip') }}</option>
                      <option value="pdf">{{ __('adminstaticword.Pdf') }}</option>
                    </select>
                  </div>
                  <br>



                  <!--for audio -->
                  <div class="col-md-12 display-none" id="audioChoose">
                    <input type="radio" name="checkAudio" id="ch11" value="audiourl"> {{ __('adminstaticword.URL') }}
                    <input type="radio" name="checkAudio" id="ch12" value="uploadaudio"> {{ __('adminstaticword.UploadAudio') }}
                  </div>
                  
                  <div class="col-md-12 display-none" id="audioURL">
                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="audiourl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="audioUpload">
                    <label for="">{{ __('adminstaticword.UploadAudio') }}: </label>
                    <input type="file" name="audioupload" class="form-control">
                  </div>



                  <!--for image -->
                  <div class="col-md-12 display-none" id="imageChoose">
                    <input type="radio" name="checkImage" id="ch3" value="url"> {{ __('adminstaticword.URL') }}
                    <input type="radio" name="checkImage" id="ch4" value="uploadimage"> {{ __('adminstaticword.UploadImage') }}
                  </div>
                  
                  <div class="col-md-12 display-none" id="imageURL">
                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="imgurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="imageUpload">
                    <label for="">{{ __('adminstaticword.UploadImage') }}: </label>
                    <input type="file" name="image" class="form-control">
                  </div>





                  <!--video-->
                  <div class="col-md-12 display-none" id="videotype">
                    <input type="radio" name="checkVideo" id="ch1" value="url"> {{ __('adminstaticword.URL') }}
                    <input type="radio" name="checkVideo" id="ch2" value="uploadvideo">{{ __('adminstaticword.UploadVideo') }}
                    <input type="radio" name="checkVideo" id="ch9" value="iframeurl"> {{ __('adminstaticword.IframeURL') }}
                    <input type="radio" name="checkVideo" id="ch10" value="liveurl"> {{ __('adminstaticword.LiveClass') }}
                  </div>

                  <div class="col-md-12 display-none" id="videoURL">
                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="vidurl"  placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="videoUpload">
                    <label for="">{{ __('adminstaticword.UploadVideo') }}: </label>
                    <input type="file" name="video_upld" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="iframeURLBox">
                    <label for="">{{ __('adminstaticword.IframeURL') }}: </label>
                    <input type="text" name="iframe_url"  placeholder="Enter Your Iframe URL" class="form-control">
                  </div>
                  

                  <div class="col-md-12 display-none" id="liveclassBox">
                    <label for="appt">Select a Date & Time:</label>
                    <input type="datetime-local" id="date_time" name="date_time" class="form-control">
                  </div>


                  <!-- zip -->
                  <div class="col-md-12 display-none" id="zipChoose">
                    <input type="radio" value="zipURLEnable" name="checkZip" id="ch5"> {{ __('adminstaticword.URL') }}
                    <input type="radio" value="zipEnable" name="checkZip" id="ch6"> {{ __('adminstaticword.UploadZip') }}
                  </div>
                  
                  <div class="col-md-12 display-none" id="zipURL">
                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="zipurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="zipUpload">
                    <label for="">{{ __('adminstaticword.UploadZip') }}: </label>
                    <input type="file" name="uplzip" class="form-control">
                  </div>


                  <!-- pdf -->
                  <div class="col-md-12 display-none" id="pdfChoose">
                    <input type="radio" value="pdfURLEnable" name="checkPdf" id="ch7"> {{ __('adminstaticword.URL') }}
                    <input type="radio" value="pdfEnable" name="checkPdf" id="ch8"> {{ __('adminstaticword.UploadPdf') }}
                  </div>
                  
                  <div class="col-md-12 display-none" id="pdfURL">
                    <label for=""> {{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="pdfurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="pdfUpload">
                    <label for=""> {{ __('adminstaticword.UploadPdf') }}: </label>
                    <input type="file" name="pdf" class="form-control">
                  </div>
                  <br>


                  <div class="col-md-12 display-none" id="duration_video">
                    <label for=""> {{ __('adminstaticword.Duration') }}:</label>
                    <input type="text" name="duration" placeholder="Enter class duration in (mins) Eg:160" class="form-control">
                  </div>
                  <br> 

                  <div class="col-md-12 display-none" id="size">
                    <label for="">{{ __('adminstaticword.Size') }}:</label>
                    <input type="text" name="size" placeholder="Enter Your Size" class="form-control">
                  </div>
                </div>
                <br>

               
                <!-- preview video -->
                <div class="row"> 
                  <div class="col-md-12 display-none" id="previewUrl">
                    <label for="exampleInputDetails">{{ __('adminstaticword.PreviewVideo') }}:</label>
                    <li class="tg-list-item">              
                      <input name="preview_type" class="tgl tgl-skewed" id="previewvid" type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="URL" data-tg-on="Upload" for="previewvid"></label>                
                    </li>
                    <input type="hidden" name="free" value="0" id="cxv">
                 
                    <div class="display-none" id="document11">
                      <label for="exampleInputSlug">Preview {{ __('adminstaticword.UploadVideo') }}:</label>
                      <input type="file" name="video" id="video" value="" class="form-control">
                    </div> 
                    <div id="document22">
                      <label for="">Preview {{ __('adminstaticword.URL') }}: </label>
                      <input type="text" name="url" id="url"  placeholder="Enter Your URL" class="form-control" >
                    </div>
                  </div>
                </div>
                </br>
                <!-- end preview video -->


                <div class="row">  
                  <div class="col-md-4">    
                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">   
                      <input class="tgl tgl-skewed" id="c11"  type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="Deactive" data-tg-on="Active" for="c11"></label>
                    </li>
                    <input type="hidden" name="status" value="1" id="t11">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Featured') }}:</label>    
                    <li class="tg-list-item">
                      <input class="tgl tgl-skewed" id="cb100"   type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="NO" data-tg-on="YES" for="cb100"></label>
                    </li>
                    <input type="hidden" name="featured" value="1" id="c100">
                  </div>
                </div> 
                <br>
                <br>
               
                <div id="subtitle" class="display-none">
                  <label>{{ __('adminstaticword.Subtitle') }}:</label>
                  <table class="table table-bordered" id="dynamic_field">  
                    <tr> 
                        <td>
                           <div class="{{ $errors->has('sub_t') ? ' has-error' : '' }} input-file-block">
                            <input type="file" name="sub_t[]"/>
                            <p class="info">Choose subtitle file ex. subtitle.srt, or. txt</p>
                            <small class="text-danger">{{ $errors->first('sub_t') }}</small>
                          </div>
                        </td>

                        <td>
                          <input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" />
                        </td>  
                        <td><button type="button" name="add" id="add" class="btn btn-xs btn-success">
                          <i class="fa fa-plus"></i>
                        </button></td>  
                    </tr>  
                  </table>
                </div>


                <div class="box-footer">
                  <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
                </div>
             
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Model close -->    

</section> 

 

@section('script')
<!--courseclass.js is included -->

<script type="text/javascript">
 $('#previewvid').on('change',function(){

  if($('#previewvid').is(':checked')){
    $('#document11').show('fast');
    $('#document22').hide('fast');
  }else{
    $('#document22').show('fast');
    $('#document11').hide('fast');
  }

});

 tinymce.init({selector:'textarea#detail'});

</script>

<script>
    
    $( "#sortable" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }
    });

    function sendOrderToServer() {

      var order = [];
      var token = $('meta[name="csrf-token"]').attr('content');
      $('tr.row1').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "GET", 
        dataType: "json", 
        url: "{{ route('class-sort') }}",
        data: {
           order: order,
          _token: token
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });
    }
</script>

@endsection
