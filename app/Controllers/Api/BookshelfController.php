<?php

namespace App\Controllers\Api;

use Core\Response;
use Core\Request;

class BookshelfController extends \Core\Controller
{
    public function show()
    {
        if (!$this->scope('bookshelves')) {
            return Response::json([
                'status' => 403,
                'message' => 'APIを使用する権限がありません。',
            ]);
        }

        $id = $this->authorizedUser->id;

        $query = $this->query('SELECT * FROM bookshelves WHERE user_id = :id');
        $query->bind(':id', $id, \PDO::PARAM_INT);
        $result = $query->all();

        return Response::json([
            'bookshelves' => $result,
        ]);
    }

    public function single(Request $request)
    {
        $id = $this->authorizedUser->id;

        $query = $this->query('SELECT * FROM bookshelves WHERE id = :bookshelfId AND user_id = :id');
        $query->bind(':bookshelfId', $request->param, \PDO::PARAM_INT);
        $query->bind(':id', $id, \PDO::PARAM_INT);
        $result = $query->first();

        return Response::json([
            'title' => $result['title'],
        ]);
    }

    public function scope($scope)
    {
        $id = $this->authorizedUser->id;

        $query = $this->query('SELECT scope FROM api_keys WHERE user_id = :id');
        $query->bind(':id', $id, \PDO::PARAM_INT);
        $result = $query->first();

        if('*' === $result['scope']){
            return true;
        }

        $_scope = explode(',', $result['scope']);
        foreach ($_scope as $value) {
            if ($value === $scope) {
                return true;
            }
        }

        return false;
    }
}
