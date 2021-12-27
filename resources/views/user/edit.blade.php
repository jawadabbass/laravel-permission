@extends('vendor.jawad_permission.layouts.app')
@section('content')
    <h5>{{ __('Manage Users') }}</h5>
    @include('vendor.jawad_permission.layouts.alert')
    @include('vendor.jawad_permission.common_files.validation_errors')
    <form name="store_users" id="store_users" method="POST" action="{{ route('users.update', [$user->id]) }}"
        class="form" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" />
        @include('vendor.jawad_permission.user.forms.form')
        <div class="form-group">
            <label>{{ __('User has following roles!') }}</label>
            <div class="@error('role_ids') is-invalid @enderror">
                {!! generateRolesCheckBoxes($user) !!}
            </div>
            @error('role_ids')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
    </form>
@endsection
