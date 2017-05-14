<?php

class QueryBuilder
{
    protected $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function all($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Inserts new row into a table in database.
     * @param $table string
     * @param $params array
     */
    public function insert($table, $params)
    {
        $query = sprintf("insert into %s (%s) values (%s)",
            $table,
            implode(", ", array_keys($params)),
            ':' . implode(", :", array_keys($params))
        );
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
        } catch (Exception $e) {
            die('Whoops. Database error.');
        }
    }
}