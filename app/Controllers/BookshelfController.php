<?php

namespace App\Controllers;

use PDO;
use Core\Controller;
use Core\Input;
use Core\Response;
use Core\Request;

class BookshelfController extends Controller
{
    public function show()
    {
        $id = $_SESSION['id'] ?? '';

        $query = $this->query('SELECT * FROM bookshelves WHERE user_id = :id');
        $query->bind(':id', $id, PDO::PARAM_INT);
        $result['bookshelves'] = $query->all();

        return Response::view('bookshelfList', $result);
    }

    public function create()
    {
        $id = $_SESSION['id'] ?? '';
        $title = Input::request('title');
        $date = date('Y-m-d H:i:s');

        $query = $this->query('INSERT INTO bookshelves (user_id, title, created_at, updated_at) VALUE (:id, :title, :created_at, :updated_at)');
        $query->bind(':id', $id, PDO::PARAM_INT);
        $query->bind(':title', $title, PDO::PARAM_STR);
        $query->bind(':created_at', $date, PDO::PARAM_STR);
        $query->bind(':updated_at', $date, PDO::PARAM_STR);
        $query->execute();

        return Response::redirect('bookshelf');
    }

    public function update(Request $request)
    {
        $title = Input::request('title');

        $query = $this->query("UPDATE bookshelves SET title = :title WHERE id = :bookshelfId");
        $query->bind(':title', $title, PDO::PARAM_STR);
        $query->bind(':bookshelfId', $request->param, PDO::PARAM_INT);
        $query->execute();

        return Response::redirect("bookshelf/{$request->param}");

    }

    public function delete(Request $request)
    {
        $query = $this->query("DELETE FROM bookshelves WHERE id = :bookshelfId");
        $query->bind(':bookshelfId', $request->param, PDO::PARAM_STR);
        $query->execute();

        return Response::redirect('bookshelf');

    }

    public function single(Request $bookshelf)
    {
        return Response::view('bookshelfDetail', $bookshelf->record);
    }

    public function test($bookshelfId, $bookId)
    {
        var_dump($bookshelfId, $bookId);
    }
}
