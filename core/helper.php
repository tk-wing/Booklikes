<?php

function h($value){
    echo htmlspecialchars($value);
}

function e($value){
    echo $value;
}

function csrf_token(){
    return hash('sha256', session_id());
}

function csrf_field($type = 'hidden'){
    $token = csrf_token();
    echo '<input type="'.$type.'" name="_csrf_token" value="'.$token.'">';
}

function http_method($method, $type = 'hidden'){
    echo '<input type="'.$type.'" name="_http_method" value="'.$method.'">';
}
