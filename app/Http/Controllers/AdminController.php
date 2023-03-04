<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(): Factory|View|Application
    {
        $users = User::all();
        $roles = Role::all();
        $authors = Author::all();
        $genres = Genre::all();
        $books = Book::all();

        return view('admin')->with(['users' => $users,
            'roles' => $roles,
            'authors' => $authors,
            'genres' => $genres,
            'books' => $books]);
    }

    /* CRUD USERS */
    public function createUser(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|alpha:ascii',
            'password' => ['required',
                'min:6',
                function ($attribute, $value, $fail): void {
                    if (preg_match_all('/\W[A-Za-z]|\W/u', $value) === 0) {
                        $fail('The ' . $attribute . ' must contain special characters and letters only.');
                    }
                }],
            'repeat_password' => 'same:password',
            'role' => 'required',
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::query()->create([
            'login' => $request->input('login'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role'),
        ]);

        return redirect()->back();
    }

    public function deleteUser($id): RedirectResponse
    {
        User::query()->find($id)->delete();

        return redirect()->back();
    }

    public function updateUser(Request $request, $id): RedirectResponse
    {
        User::query()->find($id)->update([
            'login' => $request->input('login'),
            'password' => $request->input('password'),
            'role_id' => $request->input('role'),
        ]);

        return redirect()->back();
    }

    /* CRUD AUTHORS */
    public function createAuthor(Request $request): RedirectResponse
    {
        Author::query()->create([
            'name' => $request->input('name'),
        ]);

        return redirect()->back();
    }

    public function deleteAuthor($id): RedirectResponse
    {
        Author::query()->find($id)->delete();

        return redirect()->back();
    }

    public function updateAuthor(Request $request, $id): RedirectResponse
    {
        $author = Author::query()->find($id);
        $author->update([
            'name' => $request->input('name'),
        ]);

        $books = $request->input('books');
        $author->books()->sync($books);

        return redirect()->back();
    }

    /* CRUD GENRES  */
    public function createGenre(Request $request): RedirectResponse
    {
        Genre::query()->create([
            'name' => $request->input('name'),
        ]);

        return redirect()->back();
    }

    public function deleteGenre($id): RedirectResponse
    {
        Genre::query()->find($id)->delete();

        return redirect()->back();
    }

    public function updateGenre(Request $request, $id): RedirectResponse
    {
        $genre = Genre::query()->find($id);
        $genre->update([
            'name' => $request->input('name'),
        ]);

        $books = $request->input('books');
        $genre->books()->sync($books);

        return redirect()->back();
    }

    /* CRUD BOOKS  */
    public function createBook(Request $request): RedirectResponse
    {
        $image = $request->file('image-path');
        $imgName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/images'), $imgName);

        $book = Book::query()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_path' => 'public/assets/images/' . $imgName,
        ]);

        $authors = $request->input('authors');
        $genres = $request->input('genres');

        $book->authors()->attach($authors);
        $book->genres()->attach($genres);


        return redirect()->back();
    }

    public function deleteBook($id): RedirectResponse
    {
        Book::query()->find($id)->delete();

        return redirect()->back();
    }

    public function updateBook(Request $request, $id): RedirectResponse
    {
        $book = Book::query()->find($id);
        $book->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
        ]);

        $authors = $request->input('authors');
        $book->authors()->sync($authors);

        $genres = $request->input('genres');
        $book->genres()->sync($genres);

        return redirect()->back();
    }
}
