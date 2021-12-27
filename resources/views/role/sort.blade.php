@extends('vendor.jawad_permission.layouts.app')
@section('content')

    <h5>{{ __('Manage Roles') }}</h5>
    @include('vendor.jawad_permission.layouts.alert')
    <h3>{{ __('Drag and Drop to Sort Roles') }}</h3>
    <div id="rolesSortDataDiv"></div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            refreshRoleSortData();
        });

        function refreshRoleSortData() {
            $.ajax({
                type: "GET",
                url: "{{ route('roles.sort.data') }}",
                data: {
                    lang: 'en'
                },
                success: function(responseData) {
                    $("#rolesSortDataDiv").html('');
                    $("#rolesSortDataDiv").html(responseData);
                    /**************************/
                    $('#sortable').sortable({
                        placeholder: "ui-state-highlight",
                        update: function(event, ui) {
                            var rolesOrder = $(this).sortable('toArray').toString();
                            $.post("{{ route('roles.sort.update') }}", {
                                rolesOrder: rolesOrder,
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
