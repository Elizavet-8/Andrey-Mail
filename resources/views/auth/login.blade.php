<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login | ITIVA</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="login">
            <div class="login-body">
                <img src="/img/logo-black.svg" alt="ITIVA" class="login-logo">
                <h1 class="h1">Login</h1>
                <a
                    href="https://oauth.yandex.ru/authorize?response_type=token&client_id=7e94680f8ce047c1bbddbf29488e694b&redirect_uri=https%3A%2F%2Fdsa-nexus.ru%2Fyandex"
                    class="btn3 login-btn"
                >
                    <img src="img/Yandex.svg" alt="Yandex" class="btn-icon"> Login with Yandex
                </a>
                <a
                    class="btn3 login-btn"
                    href="/login/google"
                >
                    <img src="img/Google.svg" alt="Gmail" class="btn-icon"> Login with Gmail</a>
            </div>
        </div>
    </body>
</html>
