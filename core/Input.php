<?php
namespace Core;

class Input{
    public static function post($post){
        return trim($_POST[$post] ?? null);
    }
}
