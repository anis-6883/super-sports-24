@extends('layouts.app')

@section('content')
 
 <h2 class="card-title d-none">{{ _lang('Add Fixure') }}</h2>
<form method="post" class="ajax-submit2"  autocomplete="off" action="{{ route('fixures.store') }}" enctype="multipart/form-data">
    @csrf
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
	                          	 <option value="{{$row->id}}">{{$row->sports_name}}</option>
	                          	@endforeach
	                          </select>
                          </div>
                          
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                          	<label for="series_name">Series Name</label>
                          	<input type="text" name="series_name" class="form-control" id="series_name" placeholder="Series Name" required="">
                          </div>
                        </div>


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
                          <input type="datetime-local" name="date_time" id="date_time" class="form-control" required="">
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
                           <input type="text" name="team_one_name" class="form-control" id="team_one_name" placeholder="Name" required="">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="image_one_type">Image Type</label>
                            <select class="form-control" name="image_one_type" id="image_one_type">
                             <option value="none">None</option>
                             <option value="url">Url</option>
                             <option value="image">Image</option>
                            </select>
                          </div>
                        </div>

                      
                        
                        <div class="col-md-12" id="image_value_one" style="display: none;">
                         <div class="form-group">
                         	<label for="image_one_value">Team One Image</label>
                         	<input type="file" class="form-control dropify" name="image_one_value" id="image_one_value" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
                         </div>
                        </div>



                        <div class="col-md-12" id="image_one_input" style="display: none;">
                          <div class="form-group">
                          	<input type="text" name="image_one_value" class="form-control url_one" placeholder="URL">
                          </div>
                        </div>

                        <div class="col-md-12" id="url_one_image" style="display: none;">
                          <img style="width: 150px; height: 150px;border-radius: 10px;" src="">
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
                            <h2 class="b">{{ _lang('Team Two Information') }}</h2>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="team_one_name">Name</label>
                           <input type="text" name="team_two_name" class="form-control" id="team_one_name" placeholder="Name" required="">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="image_two_type">Image Type</label>
                            <select class="form-control" name="image_two_type" id="image_two_type">
                             <option value="none">None</option>
                             <option value="url">Url</option>
                             <option value="image">Image</option>
                            </select>
                          </div>
                        </div>


                         <div class="col-md-12" id="image_value_two" style="display: none;">
                         <div class="form-group">
                         	<label for="image_two_value">Team Two Image</label>
                         	<input type="file" class="form-control dropify" name="image_two_value" id="image_two_value" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
                         </div>
                        </div>

                        <div class="col-md-12" id="image_two_input" style="display: none;">
                          <div class="form-group">
                          	<input type="text" name="image_two_value" class="form-control url_two" placeholder="URL">
                          </div>
                        </div>

                        <div class="col-md-12" id="url_two_image" style="display: none;">
                          <img style="width: 150px; height: 150px;border-radius: 10px;" src="">
                        </div>
                       
                     
                    </div>
                       
                      
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 text-right">
       
        <button type="submit" class="btn btn-primary btn-sm">{{ _lang('Save') }}</button>
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
        $("#url_two_image img").css("display", "none");
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
  	 		$("#url_one_image img").css('display', 'none');
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
  	 		$("#url_two_image img").css('display', 'none');
  	 	}
  	 	else if(url_two)
  	 	{
  	 		$("#url_two_image").css('display', 'inline-block');
  	 		$("#url_two_image img").css('display', 'block');
  	 	    $("#url_two_image img").attr('src',url_two);
  	 	}
  	 	else
  	 	{
  	 		$("#url_two_image").css('display', 'inline-block');
  	 	    $("#url_two_image img").attr('src',url_two);
  	 	}
  	 	
  	 });

     $('#date_time').ejDateTimePicker({
       dateTimeFormat: "dddd, MMMM dd, yyyy hh:mm:ss tt",
       timePopupWidth: "150px",
       timeDisplayFormat: "hh:mm:ss tt",
       width: '300px'
    });

  });
 </script>
@endsection