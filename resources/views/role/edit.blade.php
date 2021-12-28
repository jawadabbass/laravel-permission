@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')


    <h5>{{ __('Manage Roles') }}</h5>
    @include('vendor.jawad_permission_uuid.layouts.alert')
    @include('vendor.jawad_permission_uuid.common_files.validation_errors')
    <form name="store_roles" id="store_roles" method="POST" action="{{ route(config('jawad_permission_uuid.route_name').'roles.update', [$role->id]) }}">
        <input type="hidden" name="_method" value="PUT" />

        {{ __('Role Details') }}
        @include('vendor.jawad_permission_uuid.role.forms.form')

        <label>{{ __('Role has following permissions!') }}</label>
        <div class="@error('permission_ids') is-invalid @enderror">
            {!! generatePermissionsCheckBoxes($role) !!}
        </div>
        @error('permission_ids')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
        </div>
    </form>
@endsection
