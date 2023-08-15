<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!------------------------------------------- Custom CSS Link --------------------------------------->

    <link rel="stylesheet" href="{{ asset('welcome/css/style.css') }}" />

    <!--------------------------------------------- Favicon Link --------------------------------------->

    <link rel="shortcut icon" href="{{ asset('welcome/images/LVSR Logo.svg') }}" type="image/x-icon" />

    <!--------------------------------------------- Boxicon CDN --------------------------------------->

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>LVSR</title>
</head>

<body>
    <!--------------------------------------- Navbar Section Started ----------------------------------->

    @include('welcome.includes.navbar')

    <!---------------------------------------- Navbar Section Ended ------------------------------------>

    <button id="scrollBtn" onclick="scrollToTop()"><i class='bx bx-chevron-up'></i></button>

    @yield('content')

    <!-------------------------------------------- Footer Section Started------------------------------->

    @include('welcome.includes.footer')

    <!--------------------------------------------- Footer Section Ended--------------------------------->

    <!-------------------------------------------- Custom JavaScript Link-------------------------------->

    <script src="{{ asset('welcome/js/myScript.js') }}"></script>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
