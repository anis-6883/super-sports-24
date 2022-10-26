@extends('layouts.app')

@section('content')
<h2 class="card-title d-none">{{ _lang('Add New') }}</h2>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="post" autocomplete="off" action="{{ route('popular_series.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
						
						<div class="col-md-12">
                            <div class="form-check">
                                <label class="control-label d-block">{{ _lang('Select App') }}</label>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                    <span class="form-check-sign b h4">Select All</span>
                                </label>
                                @foreach (App\Models\AppModel::where('status', 1)->get() as $app)
                                <label class="form-check-label">
                                    <input class="form-check-input appbox" type="checkbox" name="apps[]" value="{{ $app->id }}">
                                    <span class="form-check-sign b h4">
                                        <img src="{{ asset($app->app_logo) }}" width="20px" height="20px" style="margin-right: 5px; border-radius: 10px;margin-bottom: 5px;">
                                        {{ $app->app_name }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Title') }}</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Description') }}</label>
                                <textarea rows="4"  class="form-control" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Action Url') }}</label>
                                <input type="text" class="form-control" name="action_url" value="{{ old('action_url') }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Status') }}</label>
                                <select class="form-control select2" name="status" required>
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
    $('[name=sports_name]').on('keyup', function() {
        $('[name=sports_skq]').val($(this).val().replace(/\s/g, '') + '_' + $('[name=sports_skq]').data('random'))
    });
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
</script>
@endsection

