<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

/*
 * Lista wszystkich kontrahentów w danej grupie
 * */


class GroupClient
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * lista wszystkich kontrahentów
     * @param null $id_grupy
     * @return mixed[]
     */
    public function getData($id_grupy = null)
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

        if($id_grupy) {
            $query .= "
                AND k.id_grupy = '" . $id_grupy. "'";
        }

        return $this->connection->fetchAll($query);
    }
}
