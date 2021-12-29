@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')

    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ __('Manage Permissions') }}</h5>

    @include('vendor.jawad_permission_uuid.layouts.alert')
    <h3>{{ __('Drag and Drop to Sort Permissions') }}</h3>
    <div class="form-group">
        <label for="permission_group_id">{{ __('Permissions Group') }}</label>
        <select name="permission_group_id" id="permission_group_id" class="form-control"
            onchange="refreshPermissionSortData();">
            {!! generatePermissionGroupsDropDown('', false) !!}
        </select>
    </div>
    <div class="mt-3" id="permissionSortDataDiv"></div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            refreshPermissionSortData();
        });

        function refreshPermissionSortData() {
            var permission_group_id = $('#permission_group_id').val();
            if (permission_group_id != '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route(config('jawad_permission_uuid.route_name_prefix').'permissions.sort.data') }}",
                    data: {
                        permission_group_id: permission_group_id
                    },
                    success: function(responseData) {
                        $("#permissionSortDataDiv").html('');
                        $("#permissionSortDataDiv").html(responseData);
                        /**************************/
                        $('#sortable').sortable({
                            placeholder: "ui-state-highlight",
                            update: function(event, ui) {
                                var permissionOrder = $(this).sortable('toArray').toString();
                                $.post("{{ route(config('jawad_permission_uuid.route_name_prefix').'permissions.sort.update') }}", {
                                    permissionOrder: permissionOrder,
                                    _method: 'PUT',
                                    _token: '{{ csrf_token() }}'
                                })
                            }
                        });
                        $("#sortable").disableSelection();
                        /***************************/
                    }
                });
            }

        }
    </script>
@endpush
