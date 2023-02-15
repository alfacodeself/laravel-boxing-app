<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Alfa" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    @include('layouts.admin.style')

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->

<body class="loading" data-layout-mode="horizontal" data-layout-color="light" data-layout-size="fluid"
    data-topbar-color="dark" data-leftbar-position="fixed">

    <!-- Begin page -->
    <div id="wrapper">
        @if (auth()->user()->level == 'admin')
            @include('layouts.admin.topbar.admin')
            @include('layouts.admin.navbar.admin')
        @elseif (auth()->user()->level == 'trainer')
            @include('layouts.admin.topbar.trainer')
            @include('layouts.admin.navbar.trainer')
        @elseif (auth()->user()->level == 'member')
            @include('layouts.admin.topbar.member')
            @include('layouts.admin.navbar.member')
        @endif
        <div class="content-page" style="margin-top: 100px">
            <div class="content">

                @yield('content')

            </div>
            @include('layouts.admin.footer')
        </div>
    </div>
    @include('layouts.admin.script')

</body>

</html>
