@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')

    <h5>{{ __('Manage Permission Groups') }}</h5>
    @include('vendor.jawad_permission_uuid.layouts.alert')

    @include('vendor.jawad_permission_uuid.common_files.validation_errors')
    <!--begin: Datatable-->
    <form name="store_permissionGroup" id="store_permissionGroup" method="POST"
        action="{{ route(config('jawad_permission_uuid.route_name_prefix').'permissionGroup.store') }}">
        @include('vendor.jawad_permission_uuid.permissionGroup.forms.form')
        <div><button type="submit" class="btn btn-success m-1">{{ __('Submit') }}</button></div>
    </form>
@endsection
