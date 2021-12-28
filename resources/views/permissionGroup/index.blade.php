@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')

    <h5>{{ __('Manage Permission Groups') }}</h5>
    @include('vendor.jawad_permission_uuid.layouts.alert')
    @if (isAllowed('Sort Permission Groups'))
        <a href="{{ route(config('jawad_permission_uuid.route_name_prefix').'permissionGroup.sort') }}" class="btn btn-primary">{{ __('Sort Permission Group') }}</a>
    @endif
    @if (isAllowed('Add new Permission Group'))
        <a href="{{ route(config('jawad_permission_uuid.route_name_prefix').'permissionGroup.create') }}" class="btn btn-primary">{{ __('New Permission Group') }}</a>
    @endif



    <form method="post" role="form" id="permissionGroup-search-form">
        <button type="button" class="btn btn-success" onclick="showFilters();" id="showFilterBtn">{{ __('Show Filters') }}</button>
        <button type="button" class="btn btn-success" onclick="hideFilters();" id="hideFilterBtn" style="display: none;">{{ __('Hide Filters') }}</button>
        <div class="row mb-6" id="filterForm" style="display: none;">
            <div class="col-lg-3">
                <label>{{ __('Permission Group Title') }}:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"
                    placeholder="Title" data-col-index="0">
            </div>
        </div>
    </form>
    <!--begin: Datatable-->
    <table class="table table-responsive table-bordered table-hover table-checkable" id="permissionGroupDatatableAjax">
        <thead>
            <tr>
                <th>{{ __('Permission Group Title') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
    </table>

@endsection
@push('scripts')
    <script>
        $(function() {
            var oTable = $('#permissionGroupDatatableAjax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                order: [
                    [0, "asc"]
                ],
                paging: true,
                info: true,
                ajax: {
                    url: '{!! route(config('jawad_permission_uuid.route_name_prefix').'fetchPermissionGroupsAjax') !!}',
                    data: function(d) {
                        d.title = $('#title').val();
                    }
                },
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#permissionGroup-search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#permissionGroup').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function showFilters() {
            $('#filterForm').show('slow');
            $('#showFilterBtn').hide('slow');
            $('#hideFilterBtn').show('slow');
        }

        function hideFilters() {
            $('#filterForm').hide('slow');
            $('#showFilterBtn').show('slow');
            $('#hideFilterBtn').hide('slow');
        }

        function deletePermissionGroup(id) {
            var msg = '{{ __('Are you sure?') }}';
            if (confirm(msg)) {
                $.post("{{ url('permissionGroup/') }}/" + id, {
                        id: id,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        if (response == 'ok') {
                            var table = $('#permissionGroupDatatableAjax').DataTable();
                            table.row('permissionGroupDtRow' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }
    </script>
@endpush
