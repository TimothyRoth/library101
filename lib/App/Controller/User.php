<?php

namespace App\Controller;

use App\App;
use App\Model\User as Model;
use Exception;
use PDO;

class User
{

    private App $app;
    private PDO $pdo;

    /**
     * @throws Exception
     */
    public function __construct()
    {

        try {
            $this->app = new App();
            $this->pdo = $this->app->make('db::connect');
        } catch (Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }

    }

    /**
    * @return array
    * @throws Exception
    */

    public function index(): array
    {
        $sql = "SELECT * FROM users";

        try {
            $stmt = $this->pdo->query($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, Model::class);
    
            if($stmt->rowCount() > 0):
                return $stmt->fetchAll();
            endif;   
        } catch (\PDOException $e) {
            throw new \RuntimeException($e->getMessage());
        }

        return [];
    }

}