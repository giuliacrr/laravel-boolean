<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="/favicon.png" />
    <title>@yield('title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>

<body>

    <main>
        @yield('content')
    </main>


</body>

</html>
