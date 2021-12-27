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

    <link href="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/custom/datatables/datatables.bundle.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/jquery-ui/jquery-ui/jquery-ui.min.css"
        rel="stylesheet" type="text/css" />
    <script>
        var ASSET_URL = "{{ asset('/') }}";
    </script>
</head>
<!--begin::Body-->

<body>
    <div class="row">
        <div class="col-lg-3">
            <ul>
                @include('vendor.jawad_permission_uuid.layouts.navigation.user')
                @include('vendor.jawad_permission_uuid.layouts.navigation.role_permission')
            </ul>
        </div>
        <div class="col-lg-9">@yield('content')</div>
    </div>


    <script src="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}vendor/jawad_permission_uuid/plugins/bootstrap/js/bootstrap.bundle.min.js" defer></script>
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
