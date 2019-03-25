<?php
namespace Core;

class Input{
    public static function post($name){
        return $_POST[$name] ?? null;
    }

    public static function get($name){
        return $_GET[$name] ?? null;
    }

    public static function request($name){
        return $_REQUEST[$name] ?? null;
    }
}
