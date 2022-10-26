@extends('layouts.app')

@section('content')
 
 <h2 class="card-title d-none">{{ _lang('Update Fixure') }}</h2>
<form method="post" class="ajax-submit2" autocomplete="off" action="{{ route('fixures.update',$edit->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ml-2">
                            <h2 class="b">{{ _lang('Fixure') }}</h2>
                        </div>
                      
                        
                        <div class="col-md-6">
                          <div class="form-group">
                          	 <label for="sports_type_id">Select Sports Type</label>
	                          <select class="form-control select2" name="sports_type_id" id="sports_type_id" required="">
	                          	<option value="" selected="" disabled="">Select Sports Type</option>
	                          	@foreach($types as $row)
	                          	 <option value="{{$row->id}}" <?php if($edit->sports_type_id == $row->id){echo "selected";} ?>>{{$row->sports_name}}</option>
	                          	@endforeach
	                          </select>
                          </div>
                          
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                          	<label for="series_name">Series Name</label>
                          	<input type="text" name="series_name" class="form-control" id="series_name" placeholder="Series Name" required="" value="{{$edit->series_name}}">
                          </div>
                        </div>

                        <!-- @php

                      $date=date_create($edit->date_time);
                      echo date_format($date,"Y/m/d H:i A");
                        @endphp -->


                    </div>
                </div>
            </div>
        </div> 

        <div class="col-md-12">
          
          <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ml-2">
                            <h2 class="b">{{ _lang('Schedule') }}</h2>
                        </div>
                      
                        <div class="col-md-4">
                          <div class="form-group">
                          	 <label for="date_time">Date/Time</label>
                          <input type="datetime-local" name="date_time" id="date_time" class="form-control" value="{{$edit->date_time}}">
                          </div>
                          
                        </div>


                    </div>
                </div>
            </div>

        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ml-2">
                            <h2 class="b">{{ _lang('Team One Information') }}</h2>
                        </div>
                        
                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="team_one_name">Name</label>
                           <input type="text" name="team_one_name" class="form-control" id="team_one_name" placeholder="Name" required="" value="{{$edit->team_one_name}}">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="image_one_type">Image Type</label>
                            <select class="form-control" name="image_one_type" id="image_one_type">
                             <option value="none" <?php if($edit->image_one_type == 'none'){echo "selected";} ?>>None</option>
                             <option value="url" <?php if($edit->image_one_type == 'url'){echo "selected";} ?>>Url</option>
                             <option value="image" <?php if($edit->image_one_type == 'image'){echo "selected";} ?>>Image</option>
                            </select>
                          </div>
                        </div>

                      

                       @if($edit->image_one_type == 'image')  
                        <div class="col-md-12" id="image_value_one">
                         <div class="form-group">
                         	<label for="image_one_value">Team One Image</label>
                         	<input type="file" class="form-control dropify" name="image_one_value" id="image_one_value" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ asset($edit->image_one_value) }}">
                         </div>
                        </div>
                     @else
                      <div class="col-md-12" id="image_value_one" style="display: none;">
                         <div class="form-group">
                         	<label for="image_one_value">Team One Image</label>
                         	<input type="file" class="form-control dropify" name="image_one_value" id="image_one_value" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
                         </div>
                        </div>
                     @endif

                      @if($edit->image_one_type == 'url')
                       <div class="col-md-12" id="image_one_input">
                          <div class="form-group">
                          	<input type="text" name="image_one_value" class="form-control url_one" placeholder="URL" value="{{URL::to($edit->image_one_value)}}">
                          </div>
                        </div>

                        <div class="col-md-12" id="url_one_image">
                          <img style="width: 150px; height: 150px;border-radius: 10px;" src="{{URL::to($edit->image_one_value)}}">
                        </div>
                      @else
                        <div class="col-md-12" id="image_one_input" style="display: none;">
                          <div class="form-group">
                          	<input type="text" name="image_one_value" class="form-control url_one" placeholder="URL">
                          </div>
                        </div>

                        <div class="col-md-12" id="url_one_image" style="display: none;">
                          <img style="width: 100%; height: 200px;" src="">
                        </div>
                    @endif
                        
                     
                    </div>
                       
                      
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ml-2">
                            <h2 class="b">{{ _lang('Team Two Information') }}</h2>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="team_one_name">Name</label>
                           <input type="text" name="team_two_name" class="form-control" id="team_one_name" placeholder="Name" value="{{$edit->team_two_name}}">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="image_two_type">Image Type</label>
                            <select class="form-control" name="image_two_type" id="image_two_type">
                             <option value="none" <?php if($edit->image_two_type == 'none'){echo "selected";} ?>>None</option>
                             <option value="url" <?php if($edit->image_two_type == 'url'){echo "selected";} ?>>Url</option>
                             <option value="image" <?php if($edit->image_two_type == 'image'){echo "selected";} ?>>Image</option>
                            </select>
                          </div>
                        </div>

                        @if($edit->image_two_type == 'image')
                         <div class="col-md-12" id="image_value_two">
                         <div class="form-group">
                         	<label for="image_two_value">Team Two Image</label>
                         	<input type="file" class="form-control dropify" name="image_two_value" id="image_two_value" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ asset($edit->image_two_value) }}">
                         </div>
                        </div>
                        @else
                         <div class="col-md-12" id="image_value_two" style="display: none;">
                         <div class="form-group">
                         	<label for="image_two_value">Team Two Image</label>
                         	<input type="file" class="form-control dropify" name="image_two_value" id="image_two_value" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
                         </div>
                        </div>
                        @endif

                        @if($edit->image_two_type == 'url')
                         <div class="col-md-12" id="image_two_input">
                          <div class="form-group">
                          	<input type="text" name="image_two_value" class="form-control url_two" placeholder="URL" value="{{URL::to($edit->image_two_value)}}">
                          </div>
                        </div>

                        <div class="col-md-12" id="image_two_value">
                          <img style="width: 150px; height: 150px;border-radius: 10px;" src="{{URL::to($edit->image_two_value)}}">
                        </div>
                        @else
                        <div class="col-md-12" id="image_two_input" style="display: none;">
                          <div class="form-group">
                          	<input type="text" name="image_two_value" class="form-control url_two" placeholder="URL">
                          </div>
                        </div>

                        <div class="col-md-12" id="url_two_image" style="display: none;">
                          <img style="width: 100%; height: 200px;" src="">
                        </div>
                       @endif
                     
                    </div>
                       
                      
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 text-right">
       
        <button type="submit" class="btn btn-primary btn-sm">{{ _lang('Update') }}</button>
    </div>


</form>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
  $(document).ready(function(){
  	 $(document).on('change', '#image_one_type', function(){
  	 	var image_one_type = $('#image_one_type').val();
      if(image_one_type == 'none')
      {
        $("#image_one_input").css("display", "none");
        $("#url_one_image img").css("display", "none");
      }
  	 	if(image_one_type == 'image')
  	 	{
  	 		$("#image_value_one").css("display", "inline-block");
  	 		$("#image_one_input").css("display", "none");
        $("#url_one_image img").css("display", "none");
  	 	}
  	 	else if(image_one_type == 'url')
  	 	{
  	 		$("#image_one_input").css("display", "inline-block");
  	 		$("#image_value_one").css("display", "none");
  	 	}
  	 	else
  	 	{
  	 		$("#image_value_one").css("display", "none");
  	 		$("#image_one_input").css("display", "none");
  	 	}
  	 	
  	 });

  	 $(document).on('change', '#image_two_type', function(){
  	 	var image_two_type = $('#image_two_type').val();
      if(image_two_type == 'none')
      {
        $("#image_two_input").css("display", "none");
        $("#url_two_image img").css("display", "none");
      }
  	 	if(image_two_type == 'image')
  	 	{
  	 		$("#image_value_two").css("display", "inline-block");
  	 		$("#image_two_input").css("display", "none");
        $("#image_two_value img").css('display', 'none');
  	 	}
  	 	else if(image_two_type == 'url')
  	 	{
  	 		$("#image_two_input").css("display", "inline-block");
  	 		$("#image_value_two").css("display", "none");
  	 	}
  	 	else
  	 	{
  	 		$("#image_value_two").css("display", "none");
  	 		$("#image_two_input").css("display", "none");
  	 	}
  	 	
  	 });
  	 $(document).on('input', '.url_one', function(){
  	 	var url_one = $('.url_one').val();
  	 	if(url_one == '')
  	 	{
  	 		$("#image_two_value img").css('display', 'none');
  	 	}
  	 	else if(url_one)
  	 	{
  	 		$("#url_one_image").css('display', 'inline-block');
  	 		$("#url_one_image img").css('display', 'block');
  	 	    $("#url_one_image img").attr('src',url_one);
  	 	}
  	 	else
  	 	{
  	 		$("#url_one_image").css('display', 'inline-block');
  	 	    $("#url_one_image img").attr('src',url_one);
  	 	}
  	 	
  	 });

  	 $(document).on('input', '.url_two', function(){

  	 	   var url_two = $('.url_two').val();

      if(url_two == '')
      {
        $("#image_two_value img").css('display', 'none');
      }
      else if(url_two)
      {
        $("#url_timage_two_valuewimage_two_valueo_image img").css('display', 'inline-block');
        //$("#url_two_image img").css('display', 'block');
          $("#image_two_value img").attr('src',url_two);
      }
      else
      {
        $("#image_two_value").css('display', 'inline-block');
          $("#image_two_value img").attr('src',url_two);
      }
  	 	
  	 });
  });
 </script>
@endsection