<?php

namespace Framework;

use PDO;

class Database
{
  public $conn;

  /**
   *
   * Constructor for database class
   *
   * @param array $config
   * */

  public function __construct($config)
  {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
    $option = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => pdo::FETCH_OBJ
    ];

    try {
      $this->conn = new PDO($dsn, $config['username'], $config['password'], $option);
    } catch (PDOException $e) {
      throw new Exception("Database connection failed: {$e->getMessage()}");
    }
  }

  /**
   *
   * Query the database
   *
   * @param string $query
   * @param array $parms
   * @return PDOStatement
   * @throws PDOException
   * */

  public function query($query, $params = [])
  {
    $sth = $this->conn->prepare($query);
    foreach ($params as $param => $value) {
      $sth->bindValue(":" . $param, $value);
    }
    $sth->execute();
    return $sth;
  }
}
