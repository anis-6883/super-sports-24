<table class="table table-bordered">

    <tr>
        <td colspan="2" class="text-center">
            <img src="{{ asset('public/uploads/images/' . $user->image) }}" class="img-lg img-thumbnail">
        </td>
    </tr>
    <tr>
        <td>{{ _lang('First Name') }}</td>
        <td>{{ $user->first_name }}</td>
    </tr>
    <tr>
        <td>{{ _lang('Last Name') }}</td>
        <td>{{ $user->last_name }}</td>
    </tr>
    <tr>
        <td>{{ _lang('Email') }}</td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td>{{ _lang('User Type') }}</td>
        <td>{{ ucwords(str_replace('_', ' ', $user->user_type)) }}</td>
    </tr>
    <tr>
        <td>{{ _lang('Status') }}</td>
        <td>
            @if($user->status)
            <span class="badge badge-success">{{ _lang('Active') }}</span>
            @else
            <span class="badge badge-danger">{{ _lang('In-Active') }}</span>
            @endif
        </td>
    </tr>

</table>
