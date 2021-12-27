@extends('vendor.jawad_permission.layouts.app')
@section('content')
    <h5>{{ __('Manage Roles') }}</h5>
    @include('vendor.jawad_permission.layouts.alert')

    @if (isAllowed('Sort Roles'))
        <a href="{{ route('roles.sort') }}" class="btn btn-primary">{{ __('Sort Role') }}</a>
    @endif
    @if (isAllowed('Add new Role'))
        <a href="{{ route('roles.create') }}" class="btn btn-primary">{{ __('New Role') }}</a>
    @endif

    <form method="post" role="form" id="roles-search-form">
        <button type="button" class="btn btn-success" onclick="showFilters();" id="showFilterBtn">{{ __('Show Filters') }}</button>
        <button type="button" class="btn btn-success" onclick="hideFilters();" id="hideFilterBtn" style="display: none;">{{ __('Hide Filters') }}</button>
        <div class="row" id="filterForm" style="display: none;">
            <div class="col-lg-3">
                <label>{{ __('Role Title') }}:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"
                    placeholder="Title" data-col-index="0">
            </div>
        </div>
    </form>
    <!--begin: Datatable-->
    <table class="table table-responsive table-bordered table-hover table-checkable" id="rolesDatatableAjax">
        <thead>
            <tr>
                <th>{{ __('Role Title') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
    </table>
@endsection
@push('scripts')
    <script>
        $(function() {
            var oTable = $('#rolesDatatableAjax').DataTable({
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
                    url: '{!! route('fetchRolesAjax') !!}',
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
            $('#roles-search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#roles').on('keyup', function(e) {
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


        function deleteRole(id) {
            var msg = '{{ __('Are you sure?') }}';
            if (confirm(msg)) {
                $.post("{{ url('roles/') }}/" + id, {
                        id: id,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        if (response == 'ok') {
                            var table = $('#rolesDatatableAjax').DataTable();
                            table.row('rolesDtRow' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }
    </script>
@endpush
