<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
</head>
<body>
<div class="container auth-container">
    <div class="auth-form">
        <form action="{{route('createUser')}}" method="POST">
            @csrf
            <h1>Регистрация</h1>
            <div class="input-group">
                <label for="login">Логин:</label>
                <input class="inp @error('login') is-invalid @enderror"
                       name="login"
                       id="login"
                       type="text"
                       value="{{old('login')}}"
                       required>
            </div>
            <div class="input-group">
                <label for="password">Пароль:</label>
                <input class="inp @error('password') is-invalid @enderror"
                       name="password"
                       id="password"
                       type="password"
                       required>
            </div>
            <div class="input-group">
                <label for="repeat_password">Повторение пароля:</label>
                <input class="inp @error('repeat_password') is-invalid @enderror"
                       name="repeat_password"
                       id="repeat_password"
                       type="password"
                       required>
            </div>
            <button class="btn auth-btn" type="submit">Зарегистрироваться</button>
            <a class="auth-link" href="{{route('signin')}}">Уже есть аккаунт? Авторизоваться</a>
            @if($errors->any())
                <p class="error">
                    {{$errors->first()}}
                </p>
            @endif
        </form>
    </div>
</div>
</body>
</html>
