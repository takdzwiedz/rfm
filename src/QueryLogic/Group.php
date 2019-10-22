<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

/**
 * Lista wszystkich grup kontrahentów
 */

class Group
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getData()
    {
        $query =
            "
            SELECT 
                   id, id_grupy, nazwa_grupy, opis_grupy, narzut, id_ceny
            FROM kontrahenci_grupy
        ";

        return $this->connection->fetchAll($query);
    }
}