<?php

namespace App\Controller;

use App\App;
use Exception;
use \PDO;

class Book
{

    private App $app;
    private PDO $pdo;

    public function __construct()
    {
        $this->app = new App();        
        $this->pdo = $this->app->make('db::connect');
    }

    /**
    * @return array
    * @throws \Exception
    */

    public function index()
    {
        $sql = "SELECT * FROM books";

        try {
            $stmt = $this->pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Model\Book');
    
            if($stmt->rowCount() > 0):
                return $stmt->fetchAll();
            endif; 
        } catch (\PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}