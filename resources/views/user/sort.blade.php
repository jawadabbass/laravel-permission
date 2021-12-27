@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <h3 class="card-label">{{ __('Drag and Drop to Sort Users') }}</h3>
        <div class="card-body" id="usersSortDataDiv"></div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            refreshUserSortData();
        });

        function refreshUserSortData() {
            $.ajax({
                type: "GET",
                url: "{{ route('users.sort.data') }}",
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
                            $.post("{{ route('users.sort.update') }}", {
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
