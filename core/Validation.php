<?php

namespace Core;

class Validation
{
    private $errors = [];

    public function __construct($requests, $fields)
    {
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
            $this->errors[$key][] = "{$rule}文字以上で入力してください}";
        }
    }

    private function max($request, $key, $rule)
    {
        $length = strlen($request);
        if ($length > $rule) {
            $this->errors[$key][] = "{$rule}文字以下で入力してください}";
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function passed(){
        if($this->errors){
            return false;
        }
        return true;
    }
}
