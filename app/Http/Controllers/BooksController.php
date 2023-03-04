<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request): Factory|View|Application
    {
        $books = Book::query()
            ->when($request->has('rating-from'), function (Builder $builder) use ($request) {
                $builder->where('rating', '>=', $request->input('rating-from'));
            })
            ->when($request->has('rating-to'), function (Builder $builder) use ($request) {
                $builder->where('rating', '<=', $request->input('rating-to'));
            })
            ->when($request->has('authors'), function (Builder $builder) use ($request) {
                $builder->whereHas('authors', function (Builder $builder) use ($request) {
                    $builder->whereIn('id', $request->input('authors'));
                });
            })
            ->when($request->has('genres'), function (Builder $builder) use ($request) {
                $builder->whereHas('genres', function (Builder $builder) use ($request) {
                    $builder->whereIn('id', $request->input('genres'));
                });
            })
            ->when($request->has('date-sort'), function (Builder $builder) use ($request) {
                $builder->orderBy('id', $request->input('date-sort'));
            })
            ->when($request->has('rate-sort'), function (Builder $builder) use ($request) {
                $builder->orderBy('id', $request->input('rate-sort'));
            })
            ->paginate(2)->withQueryString();


        $pageCount = ceil($books->total() / $books->perPage());
        $authors = Author::all();
        $genres = Genre::all();

        return view('books', ['books' => $books,
            'authors' => $authors,
            'genres' => $genres,
            'pageCount' => $pageCount]);
    }

    public function indexBook($id): Factory|View|Application
    {
        $book = Book::query()->find($id);
        return view('book', ['book' => $book]);
    }
}
