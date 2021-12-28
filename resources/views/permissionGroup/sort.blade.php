@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')

    <h5>{{ __('Manage Permission Groups') }}</h5>
    @include('vendor.jawad_permission_uuid.layouts.alert')
    <h3>{{ __('Drag and Drop to Sort Permission Groups') }}</h3>
    <div id="permissionGroupSortDataDiv"></div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            refreshPermissionGroupSortData();
        });

        function refreshPermissionGroupSortData() {
            $.ajax({
                type: "GET",
                url: "{{ route(config('jawad_permission_uuid.route_name_prefix').'permissionGroup.sort.data') }}",
                success: function(responseData) {
                    $("#permissionGroupSortDataDiv").html('');
                    $("#permissionGroupSortDataDiv").html(responseData);
                    /**************************/
                    $('#sortable').sortable({
                        placeholder: "ui-state-highlight",
                        update: function(event, ui) {
                            var permissionGroupOrder = $(this).sortable('toArray').toString();
                            $.post("{{ route(config('jawad_permission_uuid.route_name_prefix').'permissionGroup.sort.update') }}", {
                                permissionGroupOrder: permissionGroupOrder,
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
    </script>
@endpush
