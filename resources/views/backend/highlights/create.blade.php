@extends('layouts.app')

@section('content')
<style type="text/css">

</style>
<h2 class="card-title d-none">{{ _lang('Add New') }}</h2>
<form method="post" class="ajax-submit2" autocomplete="off" action="{{ route('highlights.store') }}" enctype="multipart/form-data">
    @csrf
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Sports Type') }}</label>
                                <select class="form-control select2" name="sports_type_id" required>
                                    <option value="0">{{ _lang('Select One') }}</option>
                                    {{ create_option('sports_types', 'id', ['-', 'sports_name', 'sports_skq'], old('sports_type_id')) }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Match Title') }}</label>
                                <input type="text" class="form-control" name="match_title" value="{{ old('match_title') }}" required>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Type') }}</label>
                                <select class="form-control select2" name="cover_image_type" data-selected="{{ old('cover_image_type', 'none') }}">
                                    <option value="none">{{ _lang('None') }}</option>
                                    <option value="url">{{ _lang('Url') }}</option>
                                    <option value="image">{{ _lang('Image') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Url') }}</label>
                                <input type="text" class="form-control" name="cover_url" value="{{ old('cover_url') }}" >
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image') }}</label>
                                <input type="file" class="form-control dropify" name="cover_image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group cover_image">

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
                                <input type="text" class="form-control" name="team_one_name" value="{{ old('team_one_name') }}"  required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Type') }}</label>
                                <select class="form-control select2" name="team_one_image_type" data-selected="{{ old('team_one_image_type', 'none') }}">
                                    <option value="none">{{ _lang('None') }}</option>
                                    <option value="url">{{ _lang('Url') }}</option>
                                    <option value="image">{{ _lang('Image') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Url') }}</label>
                                <input type="text" class="form-control" name="team_one_url" value="{{ old('team_one_url') }}" >
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image') }}</label>
                                <input type="file" class="form-control dropify" name="team_one_image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group team_one_image">

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
                                <input type="text" class="form-control" name="team_two_name" value="{{ old('team_two_name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Type') }}</label>
                                <select class="form-control select2" name="team_two_image_type" data-selected="{{ old('team_two_image_type', 'none') }}">
                                    <option value="none">{{ _lang('None') }}</option>
                                    <option value="url">{{ _lang('Url') }}</option>
                                    <option value="image">{{ _lang('Image') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image Url') }}</label>
                                <input type="text" class="form-control" name="team_two_url" value="{{ old('team_two_url') }}" >
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Image') }}</label>
                                <input type="file" class="form-control dropify" name="team_two_image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group team_two_image">

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
                        <div class="field-group params-card mx-4 my-2 row" style="width: 100%;">
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger btn-xs remove">-</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Stream Title') }}</label>
                                    <input type="text" class="form-control" name="stream_title[0]"  required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Resulation') }}</label>
                                    <select class="form-control" name="resulation[0]" required>
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
                                    <select class="form-control stream_type" name="stream_type[0]" required>
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
                                    <input type="text" class="form-control" name="stream_url[0]" required>
                                </div>
                            </div>
                            <div class="col-md-6 root_stream d-none">
                                <div class="form-group">
                                    <label class="control-label">
                                        {{ _lang('Stream Key') }}
                                        <span class="required"> *</span>
                                    </label>
                                    <input type="text" class="form-control" name="stream_key[0]">
                                </div>
                            </div>
                            <div class="field-group2 params-card restricted d-none mx-4 my-2 row" style="width: 100%;">
                                <div class="col-md-5 restricted d-none">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Name') }}</label>
                                        <input type="text" class="form-control" name="name[0][]" value="Content-Type">
                                    </div>
                                </div>
                                <div class="col-md-6 restricted d-none">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Value') }}</label>
                                        <input type="text" class="form-control" name="value[0][]" value="application/json; charset=UTF-8">
                                    </div>
                                </div>
                                <div class="col-md-1 text-right restricted d-none">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-xs remove-row2">-</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-right restricted d-none">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary btn-sm add-more2">{{ _lang('Add More') }}</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" id="block__country__label">{{ _lang('Block/Unblock Countries') }}</label>
                                    <select class="form-control select2 countries" data-selected="{{ old('block_country') }}" multiple>
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
        <button type="reset" class="btn btn-danger btn-sm">{{ _lang('Reset') }}</button>
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
                <select class="form-control countries" data-selected="{{ old('block_country') }}" multiple>
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
    $('[name=team_one_image_type]').on('change', function() {
        $('[name=team_one_image]').closest('.col-md-12').addClass('d-none');
        $('[name=team_one_url]').parent().parent().addClass('d-none');
        
        if($(this).val() == 'url'){
            $('[name=team_one_url]').parent().parent().removeClass('d-none');
            
        }else if($(this).val() == 'image'){
            $('[name=team_one_image]').closest('.col-md-12').removeClass('d-none');
        }else{
            $('[name=team_one_image]').closest('.col-md-12').addClass('d-none');
            $('[name=team_one_url]').parent().parent().addClass('d-none');
        }
    });
    $('[name=team_two_image_type]').on('change', function() {
        $('[name=team_two_image]').closest('.col-md-12').addClass('d-none');
        $('[name=team_two_url]').parent().parent().addClass('d-none');
        
        if($(this).val() == 'url'){
            $('[name=team_two_url]').parent().parent().removeClass('d-none');
            
        }else if($(this).val() == 'image'){
            $('[name=team_two_image]').closest('.col-md-12').removeClass('d-none');
        }else{
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
            $('[name=cover_url]').parent().parent().removeClass('d-none');
            
        }else if($(this).val() == 'image'){
            $('[name=cover_image]').closest('.col-md-12').removeClass('d-none');
        }else{
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

    var i = 5;
    $('.add-more').on('click',function(){
        var form = $('.repeat').clone().removeClass('repeat');
        form.find('.remove').addClass('remove-row');
        form.find('.countries').select2();

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
        $(this).closest('.field-group').remove();
    });

    $(document).on('click','.remove-row2',function(){
        $(this).closest('.field-group2').remove();
    });

    $(document).on('change', '.countries', function() {
        console.log($(this).val())
        $(this).parent().find('.block_country').val($(this).val());
        /* Act on the event */
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

