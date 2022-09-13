<?php

namespace App\Controller\Http\Db;

class Connection
{
    private $pdo;

    public function connect()
    {
        try {
            if ($this->pdo == null) {
                $dns = $this->setDSN();
                $this->pdo = new \PDO($dns);
            }
            return $this->pdo;
        } catch (\PDOException $e) {
            print "Connection failed: " . $e->getMessage();
        }
    }

    private function setDSN()
    {
        // https://www.php.net/manual/en/function.include.php#example-126
        $in = __DIR__ . '/Database.php';
        ['default' => $default, 'connections' => $connections] = include $in;
        ['driver' => $driver, 'database' => $database] = $connections[$default];
        return $driver . ':' . __DIR__ . '/../../../../' . $database;
    }
}
