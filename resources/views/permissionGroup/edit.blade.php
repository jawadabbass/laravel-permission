@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')

    <h5>{{ __('Manage Permission Groups') }}</h5>
    @include('vendor.jawad_permission_uuid.layouts.alert')

    @include('vendor.jawad_permission_uuid.common_files.validation_errors')
    <!--begin: Datatable-->
    <form name="store_permissionGroup" id="store_permissionGroup" method="POST" action="{{ route('permissionGroup.update', [$permissionGroup->id]) }}">
        <input type="hidden" name="_method" value="PUT" />
         @include('vendor.jawad_permission_uuid.permissionGroup.forms.form')
        <div><button type="submit" class="btn btn-success">{{ __('Update') }}</button></div>
    </form>
@endsection
