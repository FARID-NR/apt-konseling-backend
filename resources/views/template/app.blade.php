<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        KOFARMA Dashboard
    </title>
    <!--     Fonts and icons     -->
    <!-- style -->
    @include('template.style')
    <!-- end style -->
</head>

<body class="g-sidenav-show  bg-gray-200">

    <!-- sidebar -->
    @include('template.sidebar')
    <!-- end sidebar -->

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <!-- navbar -->
        @include('template.navbar')
        <!-- end navbar -->

        <!-- content -->
            @yield('content')
        <!-- end content -->
       
        @include('template.footer')
    </main>

    <!-- script -->
    @include('template.script')
    <!-- end script -->
</body>

</html>