@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')
    <h5>{{ __('Manage Users') }}</h5>
    @include('vendor.jawad_permission_uuid.layouts.alert')
    @include('vendor.jawad_permission_uuid.common_files.validation_errors')
    <form name="store_users" id="store_users" method="POST"
        action="{{ route(config('jawad_permission_uuid.route_name_prefix') . 'users.store') }}" class="form"
        enctype="multipart/form-data">
        @include('vendor.jawad_permission_uuid.user.forms.form')
        <div class="form-group m-3">
            <label>{{ __('User has following roles!') }}</label>
            <div class="@error('role_ids') is-invalid @enderror">
                {!! generateRolesCheckBoxes($user) !!}
            </div>
            @error('role_ids')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success m-1">{{ __('Submit') }}</button>
    </form>
@endsection
