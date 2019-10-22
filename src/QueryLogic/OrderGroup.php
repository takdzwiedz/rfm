<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

/**
 * Class OrderGroup
 * @package App\QueryLogic
 *
 * Lista kontrahentów z ich przynależnością do grupy ilością zamówień i wartością zamówień
 */

class OrderGroup
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getData($group = null)
    {
        $query = "
            SELECT
                z.id_kontrahenta id_kontrahenta,
                k.nazwa_kontrahenta nazwa_kontrahenta,
                kg.nazwa_grupy nazwa_grupy,
                COUNT(z.id_kontrahenta) ilosc_zamowien,
                SUM(z.wartosc_netto) wartosc_netto
            FROM zamowienia z
            LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
            LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
            WHERE k.id_kontrahenta > 0

        ";
        if ($group) {
            $query .= "AND nazwa_grupy = '" . $group . "'";
        }
        $query .= " GROUP BY id_kontrahenta";

        return  $this->connection->fetchAll($query);
    }
}
