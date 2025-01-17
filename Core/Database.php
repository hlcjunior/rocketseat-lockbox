<?php

namespace Core;

use PDO;
use PDOStatement;

class Database
{
    private PDO $db;

    public function __construct(array $config)
    {
        $connectionString = $config['driver'].':'.$config['database'];
        $this->db = new PDO($connectionString);
    }

    public function query(string $query, mixed $class = null, array $params = []): false|PDOStatement
    {
        $prepare = $this->db->prepare($query);

        if($class){
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }


        $prepare->execute($params);

        return $prepare;

    }
}
