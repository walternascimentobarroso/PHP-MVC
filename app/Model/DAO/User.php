<?php

namespace App\Model\DAO;

use App\Controller\Http\Db\Connection;

class User
{

    private $pdo;
    private $table = 'users';

    public function __construct()
    {
        $this->pdo = (new Connection())->connect();
    }

    public function createTables()
    {
        $commands = <<<TABLE
    CREATE TABLE IF NOT EXISTS $this->table (
        id   INTEGER PRIMARY KEY,
        name   VARCHAR (255),
        email VARCHAR (255)
    )
TABLE;

        try {
            $this->pdo->exec($commands);
            echo "Success!\n";
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM $this->table");
        $data = [];
        $i = 0;
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[$i]["id"] = $row["id"];
            $data[$i]["name"] = $row["name"];
            $data[$i]["email"] = json_decode($row["email"]);
            $i++;
        }

        return $data;
    }

    public function get($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data["name"] = $row["name"];
            $data["email"] = json_decode($row["email"]);
        }

        return $data;
    }

    public function insert($data)
    {
        $sql = "INSERT INTO $this->table (name, email) VALUES (:name, :email)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":name", $data["name"]);
        $stmt->bindValue(":email", json_encode($data["email"]));
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql =
            "UPDATE $this->table SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":name", $data["name"]);
        $stmt->bindValue(":email", json_encode($data["email"]));

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id]);
        return $stmt->rowCount();
    }
}
