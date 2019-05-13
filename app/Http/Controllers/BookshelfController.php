<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelf;
use App\Models\Category;
use App\Http\Requests\BookshelfStoreRequest;
use App\Http\Requests\BookshelfUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\BookRemoveRequest;
use App\Http\Requests\BookshelfDeleteRequest;

class BookShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookshelves = auth()->user()->bookshelves()->orderBy('created_at')->paginate(12);
        return view('bookshelf.index', [
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
        return view('bookshelf.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookshelfStoreRequest $request)
    {
        $bookshelf = new Bookshelf;
        $bookshelf->user_id = auth()->user()->id;
        $bookshelf->title = $request->title;
        $bookshelf->save();

        $categoryIds = new Collection($request->categories);
        $categoryIds = $categoryIds->unique();
        $bookshelf->categories()->attach($categoryIds);

        return redirect('/bookshelf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bookshelf $bookshelf)
    {
        $keyword = $request->keyword;

        $books = $bookshelf->books()->with('category')->paginate(12);

        return view('bookshelf.show', [
            'bookshelf' => $bookshelf,
            'books' => $books,
            'keyword' => $keyword,
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
    public function update(BookshelfUpdateRequest $request, Bookshelf $bookshelf)
    {
        $bookshelf->title = $request->title;
        $bookshelf->save();

        return redirect('/bookshelf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookshelf $bookshelf, BookshelfDeleteRequest $request)
    {
        $bookshelf->books()->detach();
        $bookshelf->categories()->detach();
        $bookshelf->delete();

        return redirect('/bookshelf');
    }

    public function remove(Bookshelf $bookshelf, Book $book, BookRemoveRequest $request){
        $bookshelf->books()->detach($book->id);

        return redirect("/bookshelf/{$bookshelf->id}");
    }
}
