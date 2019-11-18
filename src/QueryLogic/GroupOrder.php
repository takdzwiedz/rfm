<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

/**
 * Class ClientGroup
 * @package App\QueryLogic
 *
 * Zamówienia w grupach
 */

class GroupOrder
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAll($id_group = null, $from = null, $to= null)
    {
        $query = "
                SELECT k.id_grupy,
                       kg.nazwa_grupy,
                       count(k.id_grupy) ilosc_zamowien_w_grupie,
                       sum(z.wartosc_netto) wartosc_zamowien_netto,
                       sum(z.wartosc_brutto) wartosc_zamowien_brutto
                FROM kontrahenci k
                         LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
                         LEFT JOIN zamowienia z on k.id_kontrahenta = z.id_kontrahenta
                WHERE z.id_kontrahenta > 0
        ";
        if ($id_group) {
            $query .= "AND kg.id_grupy = '" . $id_group . "'";
        }
        if ($from) {
            $query .= " AND z.data_zlozenia >= CAST('" . $from . "' AS DATE)";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= CAST('" . $to . "' AS DATE)";
        }
        $query .= " GROUP BY k.id_grupy ORDER BY wartosc_zamowien_netto DESC";
        dump($query);
        return $clientGroup = $this->connection->fetchAll($query);
    }

    public function getGroup($id_group = null, $from = null, $to= null, $id_client = null)
    {
        $query = "
            SELECT
                z.id_kontrahenta id_kontrahenta,
                k.nazwa_kontrahenta nazwa_kontrahenta,
                kg.nazwa_grupy nazwa_grupy,
                COUNT(z.id_kontrahenta) ilosc_zamowien,
                SUM(z.wartosc_netto) wartosc_netto,
                SUM(z.wartosc_brutto) wartosc_brutto
            FROM zamowienia z
            LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
            LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
            WHERE k.id_kontrahenta > 0

        ";
        if ($id_group) {
            $query .= "AND kg.id_grupy = '" . $id_group . "'";
        }
        if ($id_client) {
            $query .= "AND k.id_kontrahenta = '" . $id_client . "'";
        }
        if ($from) {
            $query .= " AND z.data_zlozenia >= CAST('" . $from . "' AS DATE)";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= CAST('" . $to . "' AS DATE)";
        }
        $query .= " GROUP BY id_kontrahenta";
//dump($query);
        return  $this->connection->fetchAll($query);
    }
}
