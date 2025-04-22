<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <h3 class="header__heading">Mogitate</h3>
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>