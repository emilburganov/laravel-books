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
            <h1>Все книги на сайте:</h1>
            <div class="books-container-flex">
                <div class="books-container">
                    @foreach($books as $book)
                        <div class="book-card">
                            <img src="{{$book->image_path}}" alt="book" width="285" height="285">
                            <div class="book-about">
                                <p>{{$book->title}}</p>
                                <p>{{$book->description}}</p>
                                <p class="book-rate">Средняя оценка: <img
                                        src="{{asset('public/assets/images/star.png')}}"
                                        alt="star" width="25" height="25">
                                    <span>{{$book->rating}}</span>
                                </p>
                                <a class="btn btn-red fit-btn" href="{{route('book', ['id' => $book->id])}}">Перейти</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="filters-container">
                    <div class="filters">
                        <form action="{{route('books')}}">
                            <h2>Сортировка и фильтры</h2>
                            <div class="input-group">
                                <label class="input-label" for="date-sort">По дате добавления:</label>
                                <select class="inp" id="date-sort" name="date-sort">
                                    <option value="asc">Сначала старые</option>
                                    <option value="desc">Сначала новые</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <label class="input-label" for="rate-sort">По среднему баллу оценки:</label>
                                <select class="inp" id="rate-sort" name="rate-sort">
                                    <option value="asc">Сначала низкий</option>
                                    <option value="desc">Сначала высокий</option>
                                </select>
                            </div>
                            <div class="filter-category-group">
                                <h3 class="input-label">Средний балл оценок:</h3>
                                <div class="double-input-group">
                                    <div class="input-group">
                                        <label for="rating-from">От:</label>
                                        <input class="inp"
                                               id="rating-from"
                                               type="number"
                                               name="rating-from"
                                               value="1.0"
                                               max="5.0"
                                               min="1"
                                               step="0.1">
                                    </div>
                                    <div class="input-group">
                                        <label for="rating-to">До:</label>
                                        <input class="inp"
                                               id="rating-to"
                                               type="number"
                                               name="rating-to"
                                               value="5.0"
                                               max="5.0"
                                               min="1"
                                               step="0.1">
                                    </div>
                                </div>
                            </div>
                            <div class="filter-category-group">
                                <h3 class="input-label">Авторы:</h3>
                                <div class="input-group">
                                    <label for="authors">Выберите авторов:</label>
                                    <select class="inp"
                                            id="authors"
                                            name="authors[]"
                                            multiple>
                                        @foreach($authors as $author)
                                            <option value="{{$author->id}}">{{$author->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="filter-category-group">
                                <h3 class="input-label">Жанры:</h3>
                                <div class="input-group">
                                    <label for="genres">Выберите жанры:</label>
                                    <select class="inp"
                                            id="genres"
                                            name="genres[]"
                                            multiple>
                                        @foreach($genres as $genre)
                                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-red" type="submit">Найти</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pagination">
                @for($i = 1; $i <= $pageCount; $i++)
                    <a class="btn @if($books->CurrentPage() === $i) active-pag-btn @endif pag-btn"
                       href="{{$books->url($i)}}">{{$i}}</a>
                @endfor
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
