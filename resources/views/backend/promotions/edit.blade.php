@extends('layouts.app')

@section('content')
<h2 class="card-title d-none">{{ _lang('Edit') }}</h2>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" autocomplete="off" action="{{ route('promotions.update', $promotion->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check">
                                @php
                                $promotion_apps = json_decode($promotion->apps);
                                $checked = '';

                                if(count($promotion_apps) == counter('apps', ['status' => 1])){
                                    $checked = 'checked';
                                }
                                @endphp
                                <label class="control-label d-block">
                                    {{ _lang('Select App') }}
                                    <span class="required"> *</span>
                                </label>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" id="checkAll" {{ $checked }}>
                                    <span class="form-check-sign b h4">Select All</span>
                                </label>
                                @foreach (App\Models\AppModel::where('status', 1)->get() as $app)
                                @php
                                $checked = '';

                                if(in_array($app->id, $promotion_apps)){
                                    $checked = 'checked';
                                }
                                @endphp
                                <label class="form-check-label">
                                    <input class="form-check-input appbox" type="checkbox" name="apps[]" value="{{ $app->id }}" {{ $checked }}>
                                    <span class="form-check-sign b h4">
                                        <img src="{{ asset($app->app_logo) }}" width="20px" height="20px" style="margin-right: 5px; border-radius: 10px;margin-bottom: 5px;">
                                        {{ $app->app_name }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
						@php
						 $sports_type = \App\Models\SportsType::orderBy('id','ASC')->get();
						@endphp
						<div class="col-md-12">
						  <div class="form-group">
							  <label for="sports_type_id">Select Sports Type</label>  
							  <select class="form-control select2" id="sports_type_id" name="sports_type_id" required="">
								  <option value="" selected="" disabled="">Select Sports Type</option>
								  @foreach($sports_type as $row)
								  <option value="{{$row->id}}" <?php if($promotion->sports_type_id == $row->id){echo "selected";} ?>>{{$row->sports_name}}</option>
								  @endforeach
							  </select>
						  </div>
						</div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Title') }}</label>
                                <input type="text" class="form-control" name="title" value="{{ $promotion->title }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Description') }}</label>
                                <textarea rows="4"  class="form-control" name="description">{{ $promotion->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Type') }}</label>
                                <select class="form-control select2" name="image_type" data-selected="{{ $promotion->image_type }}">
                                    <option value="none">{{ _lang('None') }}</option>
                                    <option value="url">{{ _lang('Url') }}</option>
                                    <option value="image">{{ _lang('Image') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 {{ $promotion->image_type != 'url' ? 'd-none' : '' }}">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Url') }}</label>
                                <input type="text" class="form-control" name="image_url" value="{{ $promotion->image_type == 'url' ? $promotion->image : '' }}" >
                            </div>
                        </div>
                        <div class="col-md-12 {{ $promotion->image_type != 'image' ? 'd-none' : '' }}">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image') }}</label>
                                <input type="file" class="form-control dropify" name="image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG"data-default-file="{{ $promotion->image_type == 'image' ? asset($promotion->image) : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group image">
                                @if ($promotion->image_type == 'url')
                                <img src="{{ $promotion->image_url }}" style="width: 150px; border-radius: 10px;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Action Url') }}</label>
                                <input type="text" class="form-control" name="action_url" value="{{ $promotion->action_url }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Status') }}</label>
                                <select class="form-control select2" name="status" data-selected="{{ $promotion->status }}" required>
                                    <option value="1">{{ _lang('Active') }}</option>
                                    <option value="0">{{ _lang('In-Active') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="reset" class="btn btn-danger btn-sm">{{ _lang('Reset') }}</button>
                                <button type="submit" class="btn btn-primary btn-sm">{{ _lang('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script type="text/javascript">
    $("#checkAll").click(function(){

        if(this.checked){
            $(this).parent().find('span').text('Unselect All');
        }else{
            $(this).parent().find('span').text('Select All');
        }
        $('.appbox').not(this).prop('checked', this.checked);
    });

    $(".appbox").change(function(){
        if ($('.appbox:checked').length == $('.appbox').length) {
            $("#checkAll").prop('checked', true).parent().find('span').text('Unselect All');
        }else{
            $("#checkAll").prop('checked',false).parent().find('span').text('Select All');
        }
    });
    $('[name=image_type]').on('change', function() {
        $('[name=image]').closest('.col-md-12').addClass('d-none');
        $('[name=image_url]').parent().parent().addClass('d-none');
        
        if($(this).val() == 'url'){
            $('[name=image_url]').parent().parent().removeClass('d-none');
            
        }else if($(this).val() == 'image'){
            $('[name=image]').closest('.col-md-12').removeClass('d-none');
        }else{
            $('[name=image]').closest('.col-md-12').addClass('d-none');
            $('[name=image_url]').parent().parent().addClass('d-none');
        }
    });
    $('[name=image_url]').on('keyup', function() {
        $('.image').html('<img src="' + $(this).val() + '" style="width: 150px; border-radius: 10px;">');
    });
</script>
@endsection
