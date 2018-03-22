<?php
//Class user.php

require_once('db.php');

class User {

    // database connection and table name
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // create user
    function create($email, $status){
        // posted values
        $email=htmlspecialchars($email);
        $status=(int)$status;

        $query = "select id from users where email = :email and `status` in (1, 2, 33)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email",$email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) return false;

        $query = "INSERT INTO users SET email=:email, status=:status";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":status", $status);

        return $stmt->execute();
    }

    function getUserFromIdOrEmail($param) {
        $where = (int)$param > 0 ? "id = :param" : "email = :param";

        $query = "select * from users where {$where} and `status` in (1,2) limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":param", $param);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function update($userId, $status){
        $query = "select * from users where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $userId);
        $stmt->execute();
        $email = $stmt->fetchColumn(1);

        if (!empty($email)) {
            $query = "select * from users where email = :email and `status` = 1 and id <> :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
                return false;
        }


        $query = "UPDATE users SET `status`=:status WHERE id = :user_id";

        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":status", $status);

        return $stmt->execute();
    }


}
?>