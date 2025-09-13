<?php 

namespace Core;

use PDO;

class Database 
{
    public $connection;

    public $statement;
    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query = 'select * from notes', $params = []) 
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function get(): mixed
    {
        return $this->statement->fetchall();
    }

    public function find(): mixed
    {
        return $this->statement->fetch();
    }

    public function findOrFail(): mixed
    {
        $result = $this->find();
        if (! $result)
        {
            abort(Response::NOT_FOUND);
        }
        return $result;
    }

}