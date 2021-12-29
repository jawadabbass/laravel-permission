<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    <base href="{{ url('/') }}">
    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/custom/datatables/datatables.bundle.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/jquery-ui/jquery-ui/jquery-ui.min.css"
        rel="stylesheet" type="text/css" />
    <style>
        .ui-sortable li{
            margin: 5px 0 0 0;
            cursor: pointer;
        }
    </style>
    <script>
        var ASSET_URL = "{{ asset('/') }}";
    </script>
</head>
<!--begin::Body-->

<body>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3">
                <ul>
                    @include('vendor.jawad_permission_uuid.layouts.navigation.user')
                    @include('vendor.jawad_permission_uuid.layouts.navigation.role_permission')
                </ul>
            </div>
            <div class="col-lg-9">@yield('content')</div>
        </div>
    </div>

    <script src="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/bootstrap/js/bootstrap.bundle.min.js" defer>
    </script>
    <script src="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/custom/datatables/datatables.bundle.js"
        type="text/javascript">
    </script>
    <script src="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/jquery-ui/jquery-ui/jquery-ui.min.js"
        type="text/javascript">
    </script>
    <script>
        function scrollToErrors() {
            if ($('.is-invalid').length > 0) {
                setTimeout(
                    function() {
                        $('html, body').animate({
                            scrollTop: $('.is-invalid').offset().top
                        }, 3000);
                    }, 1000);


            }
        }
        $(document).ready(function() {
            scrollToErrors();
        });

        $(document).ready(function() {
            $(".alert").delay(7000).slideUp(1500, function() {
                $(this).alert('close');
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
