@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')

    <h5>{{ __('Manage Permissions') }}</h5>
    @include('vendor.jawad_permission_uuid.layouts.alert')
    @if (isAllowed('Sort Permissions'))
        <a href="{{ route(config('jawad_permission_uuid.route_name').'permissions.sort') }}" class="btn btn-text-primary">{{ __('Sort Permission') }}</a>
    @endif
    @if (isAllowed('Add new Permission'))
        <a href="{{ route(config('jawad_permission_uuid.route_name').'permissions.create') }}" class="btn btn-primary">{{ __('New Permission') }}</a>
    @endif
    <form method="post" role="form" id="permission-search-form">
        <button type="button" class="btn btn-success" onclick="showFilters();" id="showFilterBtn">{{ __('Show Filters') }}</button>
        <button type="button" class="btn btn-success" onclick="hideFilters();" id="hideFilterBtn" style="display: none;">{{ __('Hide Filters') }}</button>
        <div class="row" id="filterForm" style="display: none;">
            <div class="col-lg-3">
                <label>{{ __('Permission Title') }}:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"
                    placeholder="Title" data-col-index="0">
            </div>
            <div class="col-lg-3">
                <label>{{ __('Permission Group') }}:</label>
                <select class="form-control" name="permission_group_id" id="permission_group_id"
                    data-col-index="1">
                    {!! generatePermissionGroupsDropDown(old('permission_group_id', '')) !!}
                </select>
            </div>
        </div>
    </form>
    <!--begin: Datatable-->
    <table class="table table-responsive table-bordered table-hover table-checkable"
        id="permissionDatatableAjax">
        <thead>
            <tr>
                <th>{{ __('Permission Title') }}</th>
                <th>{{ __('Permission Group') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
    </table>
@endsection
@push('scripts')
    <script>
        $(function() {
            var oTable = $('#permissionDatatableAjax').DataTable({
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
                    url: '{!! route(config('jawad_permission_uuid.route_name').'fetchPermissionsAjax') !!}',
                    data: function(d) {
                        d.title = $('#title').val();
                        d.permission_group_id = $('#permission_group_id').val();
                    }
                },
                columns: [{
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'permission_group_id',
                        name: 'permission_group_id'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#permission-search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#permission').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#permission_group_id').on('change', function(e) {
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

        function deletePermission(id) {
            var msg = '{{ __('Are you sure?') }}';
            if (confirm(msg)) {
                $.post("{{ url('permissions/') }}/" + id, {
                        id: id,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        if (response == 'ok') {
                            var table = $('#permissionDatatableAjax').DataTable();
                            table.row('permissionDtRow' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }

        function updatePermissionGroupId(id, prev_permission_group_id, permission_group_id) {
            var url = '{{ route(config('jawad_permission_uuid.route_name').'updatePermissionGroupId') }}';
            var msg = '{{ __('Are you sure?') }}';
            if (confirm(msg)) {
                $.post(url, {
                        id: id,
                        permission_group_id: permission_group_id,
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        //
                    });
            } else {
                $('#permission_group_id_' + id).val(prev_permission_group_id);
            }
        }
    </script>
@endpush
