<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookDeleteRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $user = auth()->user();
        $bookshelves = $user->bookshelves;

        if ($keyword) {
            $books = $user->books()->where('title', 'like', '%'.$keyword.'%')->with('category')->orderBy('created_at', 'desc')->paginate(12);
        } else {
            $books = $user->books()->with('category')->orderBy('created_at', 'desc')->paginate(12);
        }

        return view('book.index', [
            'books' => $books,
            'keyword' => $keyword,
            'bookshelves' => $bookshelves
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('book.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $book = new Book();

        if ($request->hasFile('img_name')) {
            $realPath = $request->img_name->getRealPath();
            $filename = hash_file('sha256', $realPath);
            $extension = $request->img_name->getClientOriginalExtension();
            $filename = "$filename.$extension";
            if (Book::where('img_name', $filename)->doesntExist()) {
                $request->img_name->storeAs('public/book_images', $filename);
            }
            $book->img_name = $filename;
        }

        $book->user_id = auth()->user()->id;
        $book->category_id = $request->category;
        $book->title = $request->title;
        $book->comment = $request->comment;

        $book->save();

        return redirect('/book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $categories = Category::all();
        return view('book.show', [
            'book' => $book,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        if ($request->hasFile('img_name')) {
            $realPath = $request->img_name->getRealPath();
            $filename = hash_file('sha256', $realPath);
            $extension = $request->img_name->getClientOriginalExtension();
            $filename = "$filename.$extension";
            if (Book::where('img_name', $filename)->doesntExist()) {
                $request->img_name->storeAs('public/book_images', $filename);
            }
            $book->img_name = $filename;
        }

        $book->title = $request->title;
        $book->category_id = $request->category;
        $book->comment = $request->comment;

        $book->save();

        return redirect('/book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, BookDeleteRequest $request)
    {
        $book->delete();

        return redirect('/book');
    }

    public function liked(Book $book)
    {
        auth()->user()->likes()->attach($book->id);
    }

    public function unlike(Book $book)
    {
        auth()->user()->likes()->detach($book->id);
    }

    public function favorite(Request $request)
    {
        $keyword = $request->keyword;
        $user = auth()->user();
        $bookshelves = $user->bookshelves;
        if ($keyword) {
            $books = $user->likedBooks()->where('title', 'like', '%'.$keyword.'%')->orderBy('created_at', 'desc')->paginate(12);
        } else {
            $books = $user->likedBooks()->orderBy('created_at', 'desc')->paginate(12);
        }

        return view('book.favorite', [
            'books' => $books,
            'keyword' => $keyword,
            'bookshelves' => $bookshelves
        ]);
    }

    public function add(Book $book, Request $request){
        $book->bookshelves()->attach($request->bookshelf);

        return redirect("/bookshelf/{$request->bookshelf}");
    }
}
