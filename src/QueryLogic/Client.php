<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

/**
 * Class Client
 * @package App\QueryLogic
 *
 * Lista wszystkich klientów (danej grupy)
 */


class Client
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getData($group = null, $id_client = null)
    {
        $query =
            "
            SELECT 
                k.id id,
                kg.nazwa_grupy nazwa_grupy,
                k.nazwa_skrocona nazwa_skrocona,
                k.nip nip,
                k.nazwa_kontrahenta nazwa_kontrahenta
            FROM kontrahenci k
            LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
            WHERE k.id > 0
        ";

        if($group) {
            $query .= "
                AND nazwa_grupy = '" . $group. "'";
        }
        if($id_client) {
            $query .= "
                AND k.id = '" . $id_client. "'";
        }
//        dump($query);
        return $this->connection->fetchAll($query);
    }
}
