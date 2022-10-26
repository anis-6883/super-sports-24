<!DOCTYPE html>
<html lang="en">
<head>
    <title>Institute Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap-datepicker/css/datepicker.css') }}">

</head>
<body>  
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height:100vh;">     
            <div class="col-md-8">
                <div class="card m-2">
                    <div class="card-body">
                        <header class="card-heading">
                            <h4 class="card-title text-center">
                                {{ _lang('Institute Registration') }}
                            </h4>
                        </header>
                        <form method="post" autocomplete="off" action="{{ url('institute_registration_store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                @if(Session::has('success'))
                                <div class="col-md-12 text-center">
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                </div>
                                @endif
                                @if(Session::has('error'))
                                <div class="col-md-12 text-center">
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                </div>
                                @endif
                                @foreach($errors->all() as $error)
                                <div class="col-md-12 text-center">
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                </div>
                                @endforeach

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Institute Name') }}</label>
                                        <input type="text" name="institute_name" class="form-control" value="{{ old('institute_name') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Eiin') }}</label>
                                        <input type="text" name="eiin" class="form-control" value="{{ old('eiin') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Established Date') }}</label>
                                        <input type="text" name="established_date" class="form-control datepicker" value="{{ old('established_date') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Type') }}</label>
                                        <select class="form-control select2" name="type_id" data-selected="{{ old('type_id') }}" required>
                                            <option value="">{{ _lang('Select One') }}</option>
                                            {{ create_option('institute_types', 'id', 'name') }}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Category') }}</label>
                                        <select class="form-control select2" name="category_id" data-selected="{{ old('category_id') }}" required>
                                            <option value="">{{ _lang('Select One') }}</option>
                                            {{ create_option('institute_categories', 'id', 'name') }}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Mobile') }}</label>
                                        <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Email') }}</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Address') }}</label>
                                        <textarea name="address" class="form-control" rows="4" required>{{ old('address') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Website') }}</label>
                                        <input type="text" name="website" class="form-control" value="{{ old('website') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Headmaster Name') }}</label>
                                        <input type="text" name="headmaster_name" class="form-control" value="{{ old('headmaster_name') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Total Students') }}</label>
                                        <input type="number" name="total_students" class="form-control" value="{{ old('total_students') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Institute Logo') }}</label>
                                        <input type="file" class="form-control dropify" name="institute_logo" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Headmaster Picture') }}</label>
                                        <input type="file" class="form-control dropify" name="headmaster_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">{{ _lang('Headmaster Signature') }}</label>
                                        <input type="file" class="form-control dropify" name="headmaster_signature" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="b pl-2">{{ _lang('Institute Admin Details') }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('First Name') }}</label>
                                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Last Name') }}</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Email') }}</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Password') }}</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Confirm Password') }}</label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 m-auto">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary btn-sm btn-block">{{ _lang('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
    <script src="{{ asset('public/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        //dropify
        $('.dropify').dropify();
        $("input:required, select:required, textarea:required").prev().append('<span style="color: red;"> *</span>');
        $(".dropify:required").parent().prev().append('<span style="color: red;"> *</span>');
        $(document).on('focus', '.datepicker', function () {
            $(this).datepicker({
                format: 'yyyy-mm-dd'
            }).on('changeDate', function () {
                $(this).datepicker('hide');
                $("#main_modal").css("overflow-y", "auto");
            });
        });
    </script>
</body>
</html>