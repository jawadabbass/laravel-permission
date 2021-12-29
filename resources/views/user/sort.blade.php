@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')
        <h3>{{ __('Drag and Drop to Sort Users') }}</h3>
        <div  class="mt-3" id="usersSortDataDiv"></div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            refreshUserSortData();
        });

        function refreshUserSortData() {
            $.ajax({
                type: "GET",
                url: "{{ route(config('jawad_permission_uuid.route_name_prefix').'users.sort.data') }}",
                data: {
                    lang: 'en'
                },
                success: function(responseData) {
                    $("#usersSortDataDiv").html('');
                    $("#usersSortDataDiv").html(responseData);
                    /**************************/
                    $('#sortable').sortable({
                        placeholder: "ui-state-highlight",
                        update: function(event, ui) {
                            var usersOrder = $(this).sortable('toArray').toString();
                            $.post("{{ route(config('jawad_permission_uuid.route_name_prefix').'users.sort.update') }}", {
                                usersOrder: usersOrder,
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
