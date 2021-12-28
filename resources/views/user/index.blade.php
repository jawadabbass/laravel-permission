@extends('vendor.jawad_permission_uuid.layouts.app')
@section('content')
    @include('vendor.jawad_permission_uuid.layouts.alert')
    <h3 class="card-label">{{ __('Users Management') }}</h3>
    @if (isAllowed('Add new User'))
        <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('New User') }}</a>
    @endif
    <form method="post" id="users-search-form">
        <button type="button" class="btn btn-success" onclick="showFilters();" id="showFilterBtn">{{ __('Show Filters') }}</button>
        <button type="button" class="btn btn-success" onclick="hideFilters();" id="hideFilterBtn" style="display: none;">{{ __('Hide Filters') }}</button>
        <div class="row" id="filterForm" style="display: none;">
            <div class="col-lg-3">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                    placeholder="Name" data-col-index="0" />
            </div>
            <div class="col-lg-3">
                <label for="email">{{ __('Email') }}</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control"
                    placeholder="Email" data-col-index="1" />
            </div>
        </div>
    </form>
    <table class="table table-responsive table-bordered table-hover table-checkable" id="usersDatatableAjax">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
    </table>
@endsection
@push('scripts')
    <script>
        $(function() {
            var oTable = $('#usersDatatableAjax').DataTable({
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
                    url: '{!! route('fetchUsersAjax') !!}',
                    data: function(d) {
                        d.name = $('#name').val();
                        d.email = $('#email').val();
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#users-search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#name').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#email').on('keyup', function(e) {
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

        function deleteUser(id) {
            var msg = '{{ __('Are you sure?') }}';
            if (confirm(msg)) {
                $.post("{{ url('users/') }}/" + id, {
                        id: id,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        if (response == 'ok') {
                            var table = $('#usersDatatableAjax').DataTable();
                            table.row('usersDtRow' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }
    </script>
@endpush
