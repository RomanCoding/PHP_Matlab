<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all($table, $fetchMode = null)
    {
        $statement = $this->pdo->prepare("select * from {$table} ORDER BY (id) DESC ");
        if ($fetchMode) {
            $statement->setFetchMode($fetchMode['style'], $fetchMode['class']);
        }
        else {
            $statement->setFetchMode(PDO::FETCH_ASSOC);
        }
        $statement->execute();
        return $statement->fetchAll();
    }

    public function where($table, $params, $fetchMode = null)
    {

        $query = "select * from {$table} where ";
        $keys = array_map(function ($param) {
            return "$param=:$param";
        }, array_keys($params));
        try {
            $statement = $this->pdo->prepare($query . implode(' AND ', $keys));
            $statement->execute($params);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        if ($fetchMode) {
            $statement->setFetchMode($fetchMode['style'], $fetchMode['class']);
        }
        else {
            $statement->setFetchMode(PDO::FETCH_ASSOC);
        }
        return $statement->fetch();
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