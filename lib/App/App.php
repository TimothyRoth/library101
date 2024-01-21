<?php

namespace App;

use App\Controller\User as UserController;
use Exception;
use \PDO;

class App
{
    private array $factoryMethods = [];
    private array $instances = [];

    public function __construct()
    {

        /**
         * Bind methods to the factoryMethods array
         */

        $this->factoryMethods = [
            'db::connect' => [$this, 'connectPDO'],
            'user::controller' => [$this, 'userController'],
        ];
    }

    /**
     * @param string $entity
     * @return mixed
     * @throws Exception
     */

    public function make(string $entity): mixed
    {
        if (!isset($this->instances[$entity])) {
            $method = $this->factoryMethods[$entity];
            $this->instances[$entity] = $method();
        }

        return $this->instances[$entity];

    }

    /**
     * Define methods for your controllers
     */

     private function userController(): UserController
     {
         return new UserController();
     }

    /**
     * Define methods for your database connections
     */

    /**
     * @requires database.config.php
     * @return PDO
     */

    private function connectPDO(): PDO
    {
        return new PDO(DB . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    /**
     * @param string $sql
     * @param mixed|null $classModel
     * @return array|string
     * @throws Exception
     */

    public function mysql(string $sql, mixed $classModel = null): array|string
    {
        try {

            $stmt = $this->make('db::connect')->prepare($sql);
            $stmt->execute();
            $normalized_sql = strtolower($sql);
            echo $normalized_sql;
            if (stripos($normalized_sql, 'select') === 0 || stripos($normalized_sql, 'show') === 0 || stripos($normalized_sql, 'desc') === 0) {
                if ($classModel !== null):
                    $stmt->setFetchMode(PDO::FETCH_CLASS, $classModel);
                endif;

                $result = $stmt->fetchAll();

                if (count($result) === 1):
                    return $result[0];
                endif;

                return $result;
            }

            return "<b>Query:</b> <i>\"{$sql}\"</i>, executed successfully.";

        } catch (\PDOException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
