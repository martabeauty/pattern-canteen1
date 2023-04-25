<html>

<head>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    @powerGridStyles

</head>




<body>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Scripts -->
    @livewireScripts

    @livewire('product-table')


    @powerGridScripts


</body>

</html>
