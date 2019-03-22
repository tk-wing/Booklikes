<?php

namespace App\Controllers;

use PDO;
use Core\Controller;
use Core\Input;
use Core\Response;

class BookController extends Controller
{
    public function show(){
        $bookshelfId = $_GET['bookshelfId'];
        // $query = $this->query('SELECT s.title AS shelf_title, b.* FROM bookshelves AS s JOIN books AS b ON s.id = b.bookshelf_id WHERE s.id = :id');
        // $query->bind(':bookchelfId', $bookshelfId, PDO::PARAM_INT);
        // $result = $query->all();

        $query = $this->query('SELECT * FROM bookshelves where id = :bookshelfId');
        $query->bind(':bookshelfId', $bookshelfId, PDO::PARAM_INT);
        $result = $query->first();

        return Response::view('books', $result);
    }
}
