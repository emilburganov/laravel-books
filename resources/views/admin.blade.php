<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
</head>
<body>
<header>
    <div class="header__container">
        <a class="header__logo link" href="#">
            <p>Книги</p>
        </a>
        <div class="buttons-container">
            <a href="{{route('logoutUser')}}" class="btn auth-btn">Выйти из аккаунта</a>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <div class="tabs">
            <button data-index="1" class="btn tab-btn active">Все пользователи</button>
            <button data-index="2" class="btn tab-btn">Все авторы</button>
            <button data-index="3" class="btn tab-btn">Все жанры</button>
            <button data-index="4" class="btn tab-btn">Все книги</button>
        </div>
        {{-- USERS --}}
        <div class="category-group active">
            <table class="GeneratedTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Логин</th>
                    <th>Пароль</th>
                    <th>Роль</th>
                    <th>Удаление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <form action="{{route('adminUpdateUser', ['id' => $user->id])}}" method="POST">
                        @csrf
                        <tr>
                            <td>
                                {{$user->id}}
                            </td>
                            <td>
                                <label>
                                    <input onchange="this.form.submit()"
                                           class="inp"
                                           value="{{$user->login}}"
                                           type="text"
                                           name="login">
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input onchange="this.form.submit()"
                                           class="inp"
                                           value="{{$user->password}}"
                                           type="text"
                                           name="password">
                                </label>
                            </td>
                            <td>
                                <label>
                                    <select onchange="this.form.submit()"
                                            class="inp"
                                            name="role">
                                        @foreach($roles as $role)
                                            <option @selected($user->role->id === $role->id)
                                                    value="{{$role->id}}">
                                                {{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </td>
                            <td>
                                <a class="btn auth-btn"
                                   href="{{route('adminDeleteUser', ['id' => $user->id])}}">Удалить</a>
                            </td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
            <div class="filters-container">
                <div class="filters">
                    <h2>Добавить пользователя:</h2>
                    <form action="{{route('adminCreateUser')}}" method="POST">
                        @csrf
                        <div class="filter-category-group">
                            <div class="input-group">
                                <label for="login">Логин:</label>
                                <input class="inp"
                                       id="login"
                                       type="text"
                                       name="login"
                                       required>
                            </div>
                            <div class="input-group">
                                <label for="password">Пароль:</label>
                                <input class="inp"
                                       id="password"
                                       type="text"
                                       name="password"
                                       required>
                            </div>
                            <div class="input-group">
                                <label for="role">Роль:</label>
                                <select class="inp"
                                        id="role"
                                        name="role"
                                        required>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-red" type="submit">Добавить</button>
                        @if($errors->any())
                            <p class="error">
                                {{$errors->first()}}
                            </p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        {{-- AUTHORS --}}
        <div class="category-group">
            <table class="GeneratedTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя автора</th>
                    <th>Книги</th>
                    <th>Удаление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($authors as $author)
                    <form action="{{route('adminUpdateAuthor', ['id' => $author->id])}}" method="POST">
                        @csrf
                        <tr>
                            <td>
                                {{$author->id}}
                            </td>
                            <td>
                                <label>
                                    <input onchange="this.form.submit()"
                                           class="inp"
                                           value="{{$author->name}}"
                                           type="text"
                                           name="name">
                                </label>
                            </td>
                            <td>
                                <label>
                                    <select onchange="this.form.submit()"
                                            class="inp"
                                            name="books[]"
                                            multiple>
                                        @foreach($books as $book)
                                            <option
                                                @selected($author->books->contains($book->id)) value="{{$book->id}}">{{$book->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </td>
                            <td>
                                <a class="btn auth-btn"
                                   href="{{route('adminDeleteAuthor', ['id' => $author->id])}}">Удалить</a>
                            </td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
            <div class="filters-container">
                <div class="filters">
                    <h2>Добавить автора:</h2>
                    <form action="{{route('adminCreateAuthor')}}" method="POST">
                        @csrf
                        <div class="filter-category-group">
                            <div class="input-group">
                                <label for="name">Имя автора:</label>
                                <input class="inp"
                                       id="name"
                                       type="text"
                                       name="name"
                                       required>
                            </div>
                        </div>
                        <button class="btn btn-red" type="submit">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- GENRES --}}
        <div class="category-group">
            <table class="GeneratedTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название жанра</th>
                    <th>Книги</th>
                    <th>Удаление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($genres as $genre)
                    <form action="{{route('adminUpdateGenre', ['id' => $genre->id])}}" method="POST">
                        @csrf
                        <tr>
                            <td>
                                {{$genre->id}}
                            </td>
                            <td>
                                <label>
                                    <input onchange="this.form.submit()"
                                           class="inp"
                                           value="{{$genre->name}}"
                                           type="text"
                                           name="name">
                                </label>
                            </td>
                            <td>
                                <label>
                                    <select onchange="this.form.submit()"
                                            class="inp"
                                            name="books[]"
                                            multiple>
                                        @foreach($books as $book)
                                            <option
                                                @selected($genre->books->contains($book->id)) value="{{$book->id}}">{{$book->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </td>
                            <td>
                                <a class="btn auth-btn"
                                   href="{{route('adminDeleteGenre', ['id' => $genre->id])}}">Удалить</a>
                            </td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
            <div class="filters-container">
                <div class="filters">
                    <h2>Добавить жанр:</h2>
                    <form action="{{route('adminCreateGenre')}}" method="POST">
                        @csrf
                        <div class="filter-category-group">
                            <div class="input-group">
                                <label for="name">Название жанра:</label>
                                <input class="inp"
                                       id="name"
                                       type="text"
                                       name="name"
                                       required>
                            </div>
                        </div>
                        <button class="btn btn-red" type="submit">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- BOOKS --}}
        <div class="category-group">
            <table class="GeneratedTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название книги</th>
                    <th>Авторы</th>
                    <th>Жанры</th>
                    <th>Описание</th>
                    <th>Средняя оценка</th>
                    <th>Удаление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <form action="{{route('adminUpdateBook', ['id' => $book->id])}}" method="POST">
                        @csrf
                        <tr>
                            <td>
                                {{$book->id}}
                            </td>
                            <td>
                                <label>
                                    <input onchange="this.form.submit()"
                                           class="inp"
                                           value="{{$book->title}}"
                                           type="text"
                                           name="title">
                                </label>
                            </td>
                            <td>
                                <label>
                                    <select onchange="this.form.submit()"
                                            class="inp"
                                            name="authors[]"
                                            multiple>
                                        @foreach($authors as $author)
                                            <option
                                                @selected($book->authors->contains($author->id)) value="{{$author->id}}">{{$author->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <select onchange="this.form.submit()"
                                            class="inp"
                                            name="genres[]"
                                            multiple>
                                        @foreach($genres as $genre)
                                            <option
                                                @selected($book->genres->contains($genre->id)) value="{{$genre->id}}">{{$genre->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input onchange="this.form.submit()"
                                           class="inp"
                                           value="{{$book->description}}"
                                           type="text"
                                           name="description">
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input onchange="this.form.submit()"
                                           class="inp"
                                           value="{{$book->rating}}"
                                           type="number"
                                           name="rating"
                                           max="5"
                                           min="1"
                                           step="0.1">
                                </label>
                            </td>
                            <td>
                                <a class="btn auth-btn"
                                   href="{{route('adminDeleteBook', ['id' => $book->id])}}">Удалить</a>
                            </td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
            <div class="filters-container">
                <div class="filters">
                    <h2>Добавить книгу:</h2>
                    <form action="{{route('adminCreateBook')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="filter-category-group">
                            <div class="input-group">
                                <label for="title">Название книги:</label>
                                <input class="inp"
                                       id="title"
                                       type="text"
                                       name="title"
                                       required>
                            </div>
                        </div>
                        <div class="filter-category-group">
                            <div class="input-group">
                                <label for="authors">Авторы книги:</label>
                                <select class="inp"
                                        id="authors"
                                        name="authors[]"
                                        multiple
                                        required>
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}">{{$author->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="filter-category-group">
                            <div class="input-group">
                                <label for="genres">Жанры книги:</label>
                                <select class="inp"
                                        id="genres"
                                        name="genres[]"
                                        multiple
                                        required>
                                    @foreach($genres as $genre)
                                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="filter-category-group">
                            <div class="input-group">
                                <label for="description">Описание книги:</label>
                                <input class="inp"
                                       id="description"
                                       type="text"
                                       name="description"
                                       required>
                            </div>
                        </div>
                        <div class="filter-category-group">
                            <div class="input-group">
                                <label for="image-path">Картинка книги:</label>
                                <input class="inp"
                                       id="image-path"
                                       type="file"
                                       name="image-path"
                                       required>
                            </div>
                        </div>
                        <button class="btn btn-red" type="submit">Добавить</button>
                    </form>
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
<script src="{{asset('public/assets/js/index.js')}}"></script>
</body>
</html>
