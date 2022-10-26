<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('sports_types.update', $sports_type->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">{{ _lang('Sports Name') }}</label>
                <input type="text" class="form-control" name="sports_name" value="{{ $sports_type->sports_name }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">{{ _lang('Sports SKQ') }}</label>
                <input type="text" class="form-control" name="sports_skq" value="{{ $sports_type->sports_skq }}" readonly required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Status') }}</label>
                <select class="form-control select2" name="status" data-selected="{{ $sports_type->status }}" required>
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
