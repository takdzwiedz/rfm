<?php


namespace App\QueryLogic;

use Doctrine\DBAL\Driver\Connection;

class Security
{

    /**
     * @var Connection
     */
    private $Connection;

    public function __construct(Connection $Connection)
    {
        $this->Connection = $Connection;
    }

    public function verifyUser($username, $password)
    {
        $query = "SELECT * FROM user_auth WHERE username = :username AND password = :password";
        $stmt = $this->Connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute([
            ':username' => $username,
            ':password' => $password
        ]);
        return  $stmt->fetchAll();
    }
}
