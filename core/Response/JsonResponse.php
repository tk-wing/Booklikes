<?php

namespace Core\Response;

class JsonResponse
{
    private $json;

    public function __construct($value)
    {
        $this->json = json_encode($value);
    }

    public function render()
    {
        header('Content-Type: application/json;');
        echo $this->json;
    }
}
