<?php
namespace Core;

class Query{
    private $stmt;

    public function __construct($query, $pdo){
        $this->stmt = $pdo->prepare($query);
    }

    public function bind($p1, $p2, $p3){
        $this->stmt->bindParam($p1, $p2, $p3);
        return $this;
    }

    public function execute(){
        $this->stmt->execute();
    }

    public function first(){
        $res = $this->stmt->execute();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function all(){
        $this->stmt->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
