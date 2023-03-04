<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
</head>
<body>
<div class="container auth-container">
    <div class="auth-form">
        <form action="{{route('checkUser')}}" method="POST">
            @csrf
            <h1>Авторизация</h1>
            <div class="input-group">
                <label for="login">Логин:</label>
                <input class="inp @if(Session('message')) is-invalid @endif"
                       name="login"
                       id="login"
                       type="text"
                       {{old('login')}}
                       required>
            </div>
            <div class="input-group">
                <label for="password">Пароль:</label>
                <input class="inp @if(isset($message)) is-invalid @endif"
                       name="password"
                       id="password"
                       type="password"
                       required>
            </div>
            <button class="btn auth-btn" type="submit">Авторизоваться</button>
            <a class="auth-link" href="{{route('signup')}}">Еще нет аккаунта? Зарегистрироваться</a>
            @if(session('message'))
                <p class="error">
                    {{session('message')}}
                </p>
            @endif
        </form>
    </div>
</div>
</body>
</html>
