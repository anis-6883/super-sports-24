@extends('layouts.app')
@section('content')
<div class="card-title" style="display: none;">{{ _lang('General Settings') }}</div>
<div class="row">
    <div class="col-md-3">
        <div class="nav flex-column nav-pills nav-primary nav-pills-no-bd" id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
            <a class="nav-link active show" id="v-pills-general-settings-tab" data-toggle="pill" href="#v-pills-general-settings" role="tab" aria-controls="v-pills-general-settings" aria-selected="true">{{ _lang('General Settings') }}</a>
            <a class="nav-link" id="v-pills-links-tab" data-toggle="pill" href="#v-pills-links" role="tab" aria-controls="v-pills-email" aria-selected="false">{{ _lang('App & Social Links') }}</a>
            <a class="nav-link" id="v-pills-server-tab" data-toggle="pill" href="#v-pills-server" role="tab" aria-controls="v-pills-server" aria-selected="false">{{ _lang('Servers') }}</a>
            <a class="nav-link" id="v-pills-logo-tab" data-toggle="pill" href="#v-pills-logo" role="tab" aria-controls="v-pills-logo" aria-selected="false">{{ _lang('Logo & Icon') }}</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content" id="v-pills-without-border-tabContent">
            <div class="tab-pane fade active show" id="v-pills-general-settings" role="tabpanel" aria-labelledby="v-pills-general-settings-tab">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3 header-title card-title">{{ _lang('General Settings') }}</h3>
                        <form method="post" class="ajax-submit2 params-card" autocomplete="off" action="{{ route('store_settings') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Company Name') }}</label>
                                        <input type="text" class="form-control" name="company_name" value="{{ get_option('company_name') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Site Title') }}</label>
                                        <input type="text" class="form-control" name="site_title" value="{{ get_option('site_title') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Timezone') }}</label>
                                        <select class="form-control select2" name="timezone" required>
                                            <option value="">{{ _lang('Select One') }}</option>
                                            {{ create_timezone_option(get_option('timezone')) }}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Language') }}</label>
                                        <select class="form-control select2" name="language" required>
                                            {{ load_language( get_option('language') ) }}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            {{ _lang('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-links" role="tabpanel" aria-labelledby="v-pills-live-tab">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3 header-title card-title">{{ _lang('App & Social Links') }}</h3>
                        <form method="post" class="ajax-submit2 params-card" autocomplete="off" action="{{ route('store_settings') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Facebook') }}</label>
                                        <input type="text" class="form-control" name="facebook" value="{{ get_option('facebook') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Instagram') }}</label>
                                        <input type="text" class="form-control" name="instagram" value="{{ get_option('instagram') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Youtube') }}</label>
                                        <input type="text" class="form-control" name="youtube" value="{{ get_option('youtube') }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            {{ _lang('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-server" role="tabpanel" aria-labelledby="v-pills-server-tab">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3 header-title card-title">{{ _lang('Servers') }}</h3>
                        <form method="post" class="ajax-submit2 params-card" autocomplete="off" action="{{ route('store_settings') }}">
                            @csrf
                            <div class="row">
                                @foreach(json_decode(get_option('server')) ?? [] AS $server)
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="server[]" value="{{ $server }}" required aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text remove-row" style="">x</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <button type="button" class="btn btn-success btn-sm add-more">
                                            <span class="fas fa-plus"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            {{ _lang('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-logo" role="tabpanel" aria-labelledby="v-pills-logo-tab">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3 header-title card-title">{{ _lang('Logo & Icon') }}</h3>
                        <form method="post" class="ajax-submit2 params-card" autocomplete="off" action="{{ route('store_settings') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Logo') }}</label>
                                        <input type="file" class="form-control dropify" name="logo" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_logo() }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Site Icon') }}</label>
                                        <input type="file" class="form-control dropify" name="icon" data-allowed-file-extensions="png PNG" data-default-file="{{ get_icon() }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            {{ _lang('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <div class="col-md-12 repeat">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="server[]" value="" required aria-describedby="basic-addon2">
            <div class="input-group-append">
                <span class="input-group-text remove-row" style="">x</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script type="text/javascript">
    $(document).on('click', '.add-more', function(){
        var form = $('.repeat').clone().removeClass('repeat');

        $(this).closest('.col-md-12').before(form);
    });
    $(document).on('click','.remove-row',function(){
        $(this).closest('.col-md-12').remove();
    });
</script>
@endsection