@extends('layouts.app')

@section('content')

<style type="text/css">

</style>
<h2 class="card-title d-none">{{ _lang('Edit Information') }}</h2>
<form method="post" class="ajax-submit2" autocomplete="off" action="{{ route('highlights.update', $highlight->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ml-2">
                            <h2 class="b">{{ _lang('Match Information') }}</h2>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <label class="control-label d-block">{{ _lang('Select App') }}</label>
                                @php
                                $checked = '';
                                if(counter('highlight_apps', ['highlight_id' => $highlight->id]) == counter('apps', ['status' => 1])){
                                    $checked = 'checked';
                                }
                                @endphp
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="" id="checkAll" {{ $checked }}>
                                    <span class="form-check-sign b h4">Select All</span>
                                </label>
                                @foreach (App\Models\AppModel::where('status', 1)->get() as $app)
                                @php
                                $checked = '';
                                if(App\Models\HighlightApp::where('app_id', $app->id)->where('highlight_id', $highlight->id)->exists()){
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Sports Type') }}</label>
                                <select class="form-control select2" name="sports_type_id" required>
                                    <option value="0">{{ _lang('Select One') }}</option>
                                    {{ create_option('sports_types', 'id', ['-', 'sports_name', 'sports_skq'], $highlight->sports_type_id) }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Match Title') }}</label>
                                <input type="text" class="form-control" name="match_title" value="{{ $highlight->match_title }}" required>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Type') }}</label>
                                <select class="form-control select2" name="cover_image_type" data-selected="{{ $highlight->cover_image_type }}">
                                    <option value="none">{{ _lang('None') }}</option>
                                    <option value="url">{{ _lang('Url') }}</option>
                                    <option value="image">{{ _lang('Image') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Url') }}</label>
                                <input type="text" class="form-control" name="cover_url" value="{{ $highlight->cover_url }}" >
                            </div>
                        </div>
						
                        <div class="col-md-12 {{ ($highlight->cover_image_type == 'image') ? '' : ' d-none'}}">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image') }}</label>
                                <input type="file" class="form-control dropify" name="cover_image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG"data-default-file="{{ $highlight->cover_image ? asset($highlight->cover_image) : '' }}">
                            </div>
                        </div>
						
                        <div class="col-md-4">
                            <div class="form-group cover_image">
                                @if($highlight->cover_image_type == 'url')
                                <img src="{{ $highlight->cover_url }}" style="width: 150px; border-radius: 10px;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Status') }}</label>
                                <select class="form-control select2" name="status" data-selected="{{ $highlight->status }}" required>
                                    <option value="1">{{ _lang('Active') }}</option>
                                    <option value="0">{{ _lang('In-Active') }}</option>
                                </select>
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
                                <label class="control-label">{{ _lang('Name') }}</label>
                                <input type="text" class="form-control" name="team_one_name" value="{{ $highlight->team_one_name }}"  required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Type') }}</label>
                                <select class="form-control select2" name="team_one_image_type" data-selected="{{ $highlight->team_one_image_type }}">
                                    <option value="none">{{ _lang('None') }}</option>
                                    <option value="url">{{ _lang('Url') }}</option>
                                    <option value="image">{{ _lang('Image') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Url') }}</label>
                                <input type="text" class="form-control" name="team_one_url" value="{{ $highlight->team_one_url }}" >
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image') }}</label>
                                <input type="file" class="form-control dropify" name="team_one_image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG"data-default-file="{{ $highlight->team_one_image ? asset($highlight->team_one_image) : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group team_one_image">
                                @if($highlight->team_one_image_type == 'url')
                                <img src="{{ $highlight->team_one_url }}" style="width: 150px; border-radius: 10px;">
                                @endif
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
                            <h2 class="b">{{ _lang('Team Two Information') }}</h2>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Name') }}</label>
                                <input type="text" class="form-control" name="team_two_name" value="{{ $highlight->team_two_name }}"  required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Type') }}</label>
                                <select class="form-control select2" name="team_two_image_type" data-selected="{{ $highlight->team_two_image_type }}">
                                    <option value="none">{{ _lang('None') }}</option>
                                    <option value="url">{{ _lang('Url') }}</option>
                                    <option value="image">{{ _lang('Image') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Url') }}</label>
                                <input type="text" class="form-control" name="team_two_url" value="{{ $highlight->team_two_url }}" >
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image') }}</label>
                                <input type="file" class="form-control dropify" name="team_two_image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ $highlight->team_two_image ? asset($highlight->team_two_image) : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group team_two_image">
                                @if($highlight->team_two_image_type == 'url')
                                <img src="{{ $highlight->team_two_url }}" style="width: 150px; border-radius: 10px;">
                                @endif
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
                            <h2 class="b">{{ _lang('Streaming Source') }}</h2>
                        </div>
                        @foreach (App\Models\HighlightStreamingSource::where('highlight_id', $highlight->id)->get() as $key => $streaming_source)
                        <div class="field-group params-card mx-4 my-2 row" style="width: 100%;">
							<input type="hidden" value="no" name="is_deleted[{{ $key }}]" class="is_deleted" />
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger btn-xs remove-row">-</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Stream Title') }}</label>
                                    <input type="text" class="form-control" name="stream_title[{{ $key }}]" value="{{ $streaming_source->stream_title }}"  required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Resulation') }}</label>
                                    <select class="form-control" name="resulation[{{ $key }}]" data-selected="{{ $streaming_source->resulation }}" required>
                                        <option value="">Select One</option>
                                        <option value="1080p">1080p</option>
                                        <option value="720p">720p</option>
                                        <option value="480p">480p</option>
                                        <option value="360p">360p</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Stream Type') }}</label>
                                    <select class="form-control stream_type" name="stream_type[{{ $key }}]" data-selected="{{ $streaming_source->stream_type }}" required>
                                        <option value="">Select One</option>
                                        <option value="restricted">Restricted</option>
                                        <option value="root_stream">RootStream</option>
                                        <option value="m3u8">M3u8</option>
                                        <option value="web">Web</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Stream Url') }}</label>
                                    <input type="text" class="form-control" name="stream_url[{{ $key }}]" value="{{ $streaming_source->stream_url }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 root_stream {{ $streaming_source->stream_type != 'root_stream' ? 'd-none' : '' }}">
                                <div class="form-group ">
                                    <label class="control-label">
                                        {{ _lang('Stream Key') }}
                                        <span class="required"> *</span>
                                    </label>
                                    <input type="text" class="form-control" name="stream_key[{{ $key }}]" value="{{ $streaming_source->stream_key }}">
                                </div>
                            </div>

                            @if ( $streaming_source->stream_type == 'restricted')
                            @foreach (json_decode($streaming_source->headers) ?? [] as $key2 => $value)
                            <div class="field-group2 params-card mx-4 my-2 row {{ $streaming_source->stream_type != 'restricted' ? 'd-none' : '' }}" style="width: 100%;">
                                <div class="col-md-5 restricted">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Name') }}</label>
                                        <input type="text" class="form-control" name="name[{{ $key }}][]" value="{{ $key2 }}">
                                    </div>
                                </div>
                                <div class="col-md-6 restricted">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Value') }}</label>
                                        <input type="text" class="form-control" name="value[{{ $key }}][]" value="{{ $value }}">
                                    </div>
                                </div>
                                <div class="col-md-1 text-right restricted">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-xs remove-row2">-</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            @endif
                            
                            <div class="col-md-12 text-right restricted {{ $streaming_source->stream_type != 'restricted' ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-sm add-more2">{{ _lang('Add More') }}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" id="block__country__label">{{ _lang('Block/Unblock Countries') }}</label>
                                    <select class="form-control select2 countries" data-selected="{{ json_encode(explode(',', $streaming_source->block_country)) }}" multiple>
                                        {{ get_country_list() }}
                                    </select>
                                    <input class="block_country" type="hidden" name="block_country[]" value="{{ $streaming_source->block_country }}">
                                </div>
                            </div>
                            <div class="col-md-12">
								
                                <div class="form-group">
                                    <label class="switch">
                                        <input type="hidden" name="is_block_them[]" value="0" class="default_block_them" {{ $streaming_source->is_block_them ? 'disabled' : '' }}>
                                        <input type="checkbox" name="is_block_them[]" value="1" {{ $streaming_source->is_block_them ? 'checked' : '' }} class="is_block_them">
                                        <div class="slider round">
                                            <span class="on">Block</span>
                                            <span class="off">Unblock</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-sm add-more">{{ _lang('Add More') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary btn-sm">{{ _lang('Save') }}</button>
        </div>

    </div>
</form>
<div class="d-none">
    <div class="field-group2 params-card mx-4 my-2 row repeat2" style="width: 100%;">
        <div class="col-md-5 restricted">
            <div class="form-group">
                <label class="control-label">{{ _lang('Name') }}</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="col-md-6 restricted">
            <div class="form-group">
                <label class="control-label">{{ _lang('Value') }}</label>
                <input type="text" class="form-control" name="value">
            </div>
        </div>
        <div class="col-md-1 text-right">
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-xs remove-row2">-</button>
            </div>
        </div>
    </div>
    <div class="field-group params-card mx-4 my-2 row repeat" style="width: 100%;">
		<input type="hidden" value="no" name="is_deleted" class="is_deleted" />
        <div class="col-md-12 text-right">
            <div class="form-group">
                <button type="button" class="btn btn-danger btn-xs remove">-</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">{{ _lang('Stream Title') }}</label>
                <input type="text" class="form-control" name="stream_title"  required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">{{ _lang('Resulation') }}</label>
                <select class="form-control" name="resulation" required>
                    <option value="">Select One</option>
                    <option value="1080p">1080p</option>
                    <option value="720p">720p</option>
                    <option value="480p">480p</option>
                    <option value="360p">360p</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">{{ _lang('Stream Type') }}</label>
                <select class="form-control stream_type" name="stream_type" required>
                    <option value="">Select One</option>
                    <option value="restricted">Restricted</option>
                    <option value="root_stream">RootStream</option>
                    <option value="m3u8">M3u8</option>
                    <option value="web">Web</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">{{ _lang('Stream Url') }}</label>
                <input type="text" class="form-control" name="stream_url" required>
            </div>
        </div>
        <div class="col-md-6 root_stream d-none">
            <div class="form-group">
                <label class="control-label">
                    {{ _lang('Stream Key') }}
                    <span class="required"> *</span>
                </label>
                <input type="text" class="form-control" name="stream_key">
            </div>
        </div>
        <div class="field-group2 params-card restricted d-none mx-4 my-2 row" style="width: 100%;">
            <div class="col-md-5 restricted d-none">
                <div class="form-group">
                    <label class="control-label">{{ _lang('Name') }}</label>
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="col-md-6 restricted d-none">
                <div class="form-group">
                    <label class="control-label">{{ _lang('Value') }}</label>
                    <input type="text" class="form-control" name="value">
                </div>
            </div>
            <div class="col-md-1 text-right restricted d-none">
                <div class="form-group">
                    <button type="button" class="btn btn-danger btn-xs remove-row">-</button>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right restricted">
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-sm add-more2">{{ _lang('Add More') }}</button>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label" id="block__country__label">{{ _lang('Block/Unblock Countries') }}</label>
                <select class="form-control countries" data-selected="" multiple>
                    {{ get_country_list() }}
                </select>
                <input class="block_country" type="hidden" name="block_country[]">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="switch">
                    <input type="hidden" name="is_block_them[]" value="0" class="default_block_them">
                    <input type="checkbox" name="is_block_them[]" value="1" class="is_block_them">
                    <div class="slider round">
                      <span class="on">Block</span>
                      <span class="off">Unblock</span>
                  </div>
              </label>
          </div>
      </div>
  </div>
</div>
@endsection

@section('js-script')
<script type="text/javascript">
    @if($highlight->team_one_image_type == 'url')
    $('[name=team_one_url]').parent().parent().removeClass('d-none');
    @elseif($highlight->team_one_image_type == 'image')
    $('[name=team_one_image]').closest('.col-md-12').removeClass('d-none');
    @else
    $('[name=team_one_image]').closest('.col-md-12').addClass('d-none');
    $('[name=team_one_url]').parent().parent().addClass('d-none');
    @endif

    @if($highlight->team_two_image_type == 'url')
    $('[name=team_two_url]').parent().parent().removeClass('d-none');
    @elseif($highlight->team_two_image_type == 'image')
    $('[name=team_two_image]').closest('.col-md-12').removeClass('d-none');
    @else
    $('[name=team_two_image]').closest('.col-md-12').addClass('d-none');
    $('[name=team_two_url]').parent().parent().addClass('d-none');
    @endif

    $('[name=team_one_image_type]').on('change', function() {
        $('[name=team_one_image]').closest('.col-md-12').addClass('d-none');
        $('[name=team_one_url]').parent().parent().addClass('d-none');

        if($(this).val() == 'url'){
            $('[name=team_one_url]').parent().parent().removeClass('d-none');
            $('.team_one_image img').show();


        }else if($(this).val() == 'image'){
            $('[name=team_one_image]').closest('.col-md-12').removeClass('d-none');
            $('.team_one_image img').hide();

        }else{
            $('.team_one_image img').hide();

            $('[name=team_one_image]').closest('.col-md-12').addClass('d-none');

            $('[name=team_one_url]').parent().parent().addClass('d-none');
        }
    });
    $('[name=team_two_image_type]').on('change', function() {
        $('[name=team_two_image]').closest('.col-md-12').addClass('d-none');
        $('[name=team_two_url]').parent().parent().addClass('d-none');

        if($(this).val() == 'url'){
            $('[name=team_two_url]').parent().parent().removeClass('d-none');
            $('.team_two_image img').show();
        }else if($(this).val() == 'image'){
            $('.team_two_image img').hide();
            $('[name=team_two_image]').closest('.col-md-12').removeClass('d-none');
        }else{
            $('.team_two_image img').hide();
            $('[name=team_two_image]').closest('.col-md-12').addClass('d-none');
            $('[name=team_two_url]').parent().parent().addClass('d-none');
        }
    });

    $('[name=team_one_url]').on('keyup', function() {
        $('.team_one_image').html('<img src="' + $(this).val() + '" style="width: 150px; border-radius: 10px;">');
    });
    $('[name=team_two_url]').on('keyup', function() {
        $('.team_two_image').html('<img src="' + $(this).val() + '" style="width: 150px; border-radius: 10px;">');
    });
	
	$('[name=cover_image_type]').on('change', function() {
        $('[name=cover_image]').closest('.col-md-12').addClass('d-none');
        $('[name=cover_url]').parent().parent().addClass('d-none');
        
        if($(this).val() == 'url'){
			$('.cover_image').removeClass('d-none');
            $('[name=cover_url]').parent().parent().removeClass('d-none');
            
        }else if($(this).val() == 'image'){
			$('.cover_image').addClass('d-none');
            $('[name=cover_image]').closest('.col-md-12').removeClass('d-none');
        }else{
			$('.cover_image').removeClass('d-none');
            $('[name=cover_image]').closest('.col-md-12').addClass('d-none');
            $('[name=cover_url]').parent().parent().addClass('d-none');
        }
		
    });
	$('[name=cover_url]').on('keyup', function() {
        $('.cover_image').html('<img src="' + $(this).val() + '" style="width: 150px; border-radius: 10px;">');
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

    $(document).on('change', '.stream_type', function() {

        $dis = $(this).closest('.field-group');

        if($(this).val() == 'root_stream'){
            $dis.find('.root_stream').removeClass('d-none').find('input, select').attr('required', true);
            $dis.find('.restricted').addClass('d-none').find('input, select').attr('required', false);
        }else if($(this).val() == 'restricted'){
            $dis.find('.restricted').removeClass('d-none').find('input, select').attr('required', true);
            $dis.find('.root_stream').addClass('d-none').find('input, select').attr('required', false);
        }else{
            $dis.find('.root_stream, .restricted').addClass('d-none').attr('required', false);
            $dis.find('.restricted').addClass('d-none').find('input, select').attr('required', false);
        }
    });

    var i = +'{{ $key + 1 }}';
    $('.add-more').on('click',function(){
        var form = $('.repeat').clone().removeClass('repeat');
        form.find('.remove').addClass('remove-row');
        form.find('.countries').select2();

        form.find('[name=is_deleted]').attr('name', 'is_deleted[' + i + ']');
		form.find('[name=stream_title]').attr('name', 'stream_title[' + i + ']');
        form.find('[name=resulation]').attr('name', 'resulation[' + i + ']');
        form.find('[name=stream_type]').attr('name', 'stream_type[' + i + ']');
        form.find('[name=stream_url]').attr('name', 'stream_url[' + i + ']');
        form.find('[name=stream_key]').attr('name', 'stream_key[' + i + ']');
        form.find('[name=name]').attr('name', 'name[' + i + '][]');
        form.find('[name=value]').attr('name', 'value[' + i + '][]');

        i++;

        $(this).closest('.col-md-12').before(form);
    });

    $(document).on('click', '.add-more2', function(){
        var form = $('.repeat2').clone().removeClass('repeat2');
        var name = $(this).closest('.field-group').find('[name^="name"]:first').attr('name');
        var value = $(this).closest('.field-group').find('[name^="value"]:first').attr('name');

        form.find('[name=name]').attr('name', name);
        form.find('[name=value]').attr('name', value);

        $(this).closest('.col-md-12').before(form);
    });



    $(document).on('click','.remove-row',function(){
        $(this).closest('.field-group').addClass('d-none').find('.is_deleted').val('yes');
        $(this).closest('.field-group').find('input, select').attr('required', false);
    });

    $(document).on('click','.remove-row2',function(){
        $(this).closest('.field-group2').remove();
    });

    $(document).on('change', '.countries', function() {
        console.log($(this).val())
        $(this).parent().find('.block_country').val($(this).val());

    });

    $(document).on('change', '.is_block_them', function() {
        if(this.checked){
            $(this).parent().find('.default_block_them').attr('disabled', true);
        }else{
            $(this).parent().find('.default_block_them').attr('disabled', false);
        }
    });
</script>

@endsection

