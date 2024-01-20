<?php

namespace App\Controller;

use App\App;
use \PDO;
use Exception;
use App\Model\Borrow as Model;

class Borrow
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
        $sql = "SELECT * FROM borrows";

        try {
            $stmt = $this->pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, Model::class);
    
            if($stmt->rowCount() > 0):
                return $stmt->fetchAll();
            endif;
        } catch(\PDOException $e) {
            throw new \RuntimeException($e->getMessage());
        }
       
    }
}