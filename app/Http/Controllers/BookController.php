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
    public function index()
    {
        $books = Book::find(auth()->user()->id);
        $user = auth()->user();
        $user->load('books', 'books.category');
        $books = $user->books->sortByDesc('created_at');

        return view('book.index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $path = $request->img_name->store('public/book_images');
            $filename = pathinfo($path, PATHINFO_BASENAME);
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
        if($request->hasFile('img_name')){
            $path = $request->img_name->store('public/book_images');
            $filename = pathinfo($path, PATHINFO_BASENAME);
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
}
