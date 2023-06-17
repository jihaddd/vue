<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Vue JS CRUD Operations in Laravel</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

</head>

<body>
    <div id="app"></div>
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">image one</th>
                <th scope="col">image two</th>
                <th scope="col">title</th>
                
                
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $item)
            <tr>
                @foreach ($item['volumeInfo']['imageLinks'] as $image)
                <td><img src="{{ $image }}" class="card-img-top" alt="..."></td>
                @endforeach
                <td>{{ $item['volumeInfo']['title'] }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
     


    {{-- @foreach ($data as $item)
        <div class="card" style="width: 18rem;">
            @foreach ($item['volumeInfo']['imageLinks'] as $image)
                <img src="{{ $image }}" class="card-img-top" alt="...">
            @endforeach
            <div class="card-body">
                <h5 class="card-title">{{ $item['volumeInfo']['title'] }}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>

            </div>
        </div>
    @endforeach --}}
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>

    <script src="assets/vendors/chart.js/Chart.min.js"></script>

    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>

    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>

</body>

</html>
