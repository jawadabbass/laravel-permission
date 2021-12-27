@extends('vendor.jawad_permission.layouts.app')
@section('content')
    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('{{ __('Manage Permissions') }}') }}</h5>
    @include('vendor.jawad_permission.layouts.alert')
    @include('vendor.jawad_permission.common_files.validation_errors')
    <form name="store_permission" id="store_permission" method="POST" action="{{ route('permissions.store') }}">
        @include('vendor.jawad_permission.permission.forms.form')
        <div><button type="submit" class="btn btn-success">{{ __('Submit') }}</button></div>
    </form>
@endsection
