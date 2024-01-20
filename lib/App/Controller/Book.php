<?php

namespace App\Controller;

use App\App;
use Exception;
use \PDO;
use App\Model\Book as Model;

class Book
{

    private App $app;
    private PDO $pdo;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->app = new App();        
        $this->pdo = $this->app->make('db::connect');
    }

    /**
    * @return array
    * @throws Exception
    */

    public function index(): array
    {
        $sql = "SELECT * FROM books";

        try {
            $stmt = $this->pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, Model::class);
    
            if($stmt->rowCount() > 0):
                return $stmt->fetchAll();
            endif; 
        } catch (\PDOException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}