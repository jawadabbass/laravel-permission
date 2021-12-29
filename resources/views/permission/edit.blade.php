@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')
    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('Manage Permissions') }}</h5>
    @include('vendor.jawad_permission_uuid.layouts.alert')
    @include('vendor.jawad_permission_uuid.common_files.validation_errors')
    <form name="store_permission" id="store_permission" method="POST"
        action="{{ route(config('jawad_permission_uuid.route_name_prefix').'permissions.update', [$permission->id]) }}">
        <input type="hidden" name="_method" value="PUT" />
        @include('vendor.jawad_permission_uuid.permission.forms.form')
        <div><button type="submit" class="btn btn-success m-1">{{ __('Update') }}</button></div>
    </form>
@endsection
