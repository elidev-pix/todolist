<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lavishly+Yours&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    <div class="container">
        <p id="first">@yield('header')</p>
        <p>@yield('account')</p><br><br>
        <p id="second">@yield('second')</p>
        <div class="succes">@yield('succes')</div>
        <div>@yield('content')</div>
        <div>@yield('list')</div>    
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>