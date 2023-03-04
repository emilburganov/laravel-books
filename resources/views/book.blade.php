<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Все книги</title>
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
</head>
<body>
<header>
    <div class="header__container">
        <a class="header__logo link" href="#">
            <p>Книги</p>
        </a>
        <nav class="header__links">
            <a class="link" href="#">Избранные книги</a>
            <a class="link" href="#">Топ книг</a>
        </nav>
        <div class="buttons-container">
            @if(!Auth::check())
                <a href="{{route('signin')}}" class="btn auth-btn">Вход</a>
                <a href="{{route('signup')}}" class="btn auth-btn">Регистрация</a>
            @else
                <a href="{{route('logoutUser')}}" class="btn auth-btn">Выйти из аккаунта</a>
            @endif
        </div>
    </div>
</header>
<main>
    <div class="container">
        <div class="popular-books">
            <div class="books-container-flex book-center">
                <div class="books-container">
                    <div class="book-card">
                        <img src="{{asset('public/assets/images/book.avif')}}" alt="book">
                        <div class="book-about">
                            <p>{{$book->title}}</p>
                            <p>{{$book->description}}</p>
                            <p class="book-rate">Средняя оценка: <img src="{{asset('public/assets/images/star.png')}}"
                                                                      alt="star" width="25" height="25">
                                <span>{{$book->rating}}</span>
                            </p>
                            <a class="btn btn-red fit-btn" href="#">Перейти</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    <div class="footer-container">
        <div>
            <p>Телефон: +79146781511</p>
            <p>Почта: book@superbook.premium</p>
        </div>
        <p>Copyright © 2023 «Книги»</p>
    </div>
</footer>
</body>
</html>
