<?php

namespace Config;

use PDO;
use stdClass;

class Db
{
    private PDO $dbh;
    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->dbh = new PDO(
            $this->config->get('DB_DRIVER') . ':host=' . $this->config->get('DB_HOST') .
            ';dbname=' . $this->config->get('DB_DATABASE'),
            $this->config->get('DB_USER'),
            $this->config->get('DB_PASSWORD')
        );
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Execute a query with optional parameters and return the first result as an associative array.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params An associative array of parameters to bind to the query.
     *
     * @return mixed The first result as an associative array, or null if no results are found.
     */
    public function query(string $sql, array $params = []): mixed
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Insert data into a specified database table.
     *
     * @param string $table The name of the table to insert data into.
     * @param array $data An associative array of column names and their corresponding values.
     *
     * @return int The ID of the inserted row.
     */
    public function insert(string $table, array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        $stmt = $this->dbh->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        $stmt->execute();

        return $this->dbh->lastInsertId();
    }

    /**
     * Update records in a specified database table based on a WHERE clause.
     *
     * @param string $table The name of the table to update records in.
     * @param array $data An associative array of column names and their new values.
     * @param string $where The WHERE clause to specify which records to update.
     * @param array $params An associative array of parameters to bind to the WHERE clause.
     *
     * @return int The number of rows affected by the update.
     */
    public function update(string $table, array $data, string $where, array $params = []): int
    {
        $set = [];

        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }
        $set = implode(', ', $set);

        $sql = "UPDATE $table SET $set WHERE $where";

        $stmt = $this->dbh->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();

        return $stmt->rowCount();
    }
}
