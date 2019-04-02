<?php

namespace Core;

class Validation
{
    private $errors = [];
    private $pdo;

    public function __construct($requests, $fields, $pdo)
    {
        $this->pdo = $pdo;

        foreach ($fields as $key => $value) {
            $request = $requests[$key] ?? '';
            $rules = explode('|', $value);

            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $func = $rule[0];
                $this->$func($request, $key, $rule[1] ?? null);
            }
        }
    }

    private function exists($request, $key)
    {
        $id = $_SESSION['id'];
        $key = str_replace('`', '``', $key);

        $sql = "SELECT `$key` FROM bookshelves WHERE user_id = :id AND title = :title";
        $query = new Query($sql, $this->pdo);
        $query->bind(':id', $id, \PDO::PARAM_INT);
        $query->bind(':title', $request, \PDO::PARAM_STR);
        $result = $query->first();

        if ($result) {
            $this->errors[$key][] = 'すでに登録されています。';
        }
    }

    private function required($request, $key)
    {
        if (!$request) {
            $this->errors[$key][] = '入力必須です。';
        }
    }

    private function min($request, $key, $rule)
    {
        $length = strlen($request);
        if ($length < $rule) {
            $this->errors[$key][] = "{$rule}文字以上で入力してください。";
        }
    }

    private function max($request, $key, $rule)
    {
        $length = strlen($request);
        if ($length > $rule) {
            $this->errors[$key][] = "{$rule}文字以下で入力してください。";
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return (bool) $this->errors;
    }
}
