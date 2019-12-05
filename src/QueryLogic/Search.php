<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Driver\Connection;

class Search
{

    /**
     * @var Connection
     */
    private $Connection;

    public function __construct(Connection $Connection)
    {
        $this->Connection = $Connection;
    }

    public function search($value)
    {
        $query = "SELECT * FROM artykuly WHERE nazwa_artykulu LIKE :value ";
        $stmt = $this->Connection->prepare($query);
        $stmt->execute([
            ':value' =>   "%".$value."%",
        ]);

        dump($query);
        return  $stmt->fetchAll();
    }
}
