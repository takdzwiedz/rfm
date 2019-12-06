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

    /**
     * Pobieranie wszystkich grup, w których dokonano zakupu konkretnego produktu
     * @param null $id_group
     * @param null $from
     * @param null $to
     * @param null $id_product
     * @return mixed[]
     */
    public function getAll($id_group = null, $from = null, $to = null, $id_product = null)
    {
        $query = "
            SELECT IFNULL(kg.id_grupy, -1)                                              id_grupy,
                   IFNULL(kg.nazwa_grupy, 'Brak przypisanej grupy')                     nazwa_grupy,
                   count(distinct zp.id_ezamowienia)                                    ilosc_zamowien_w_grupie,
                   sum(zp.cena_netto * zp.ilosc)                                        wartosc_zamowien_netto,
                   sum(zp.cena_brutto * zp.ilosc)                                       wartosc_zamowien_brutto
            FROM zamowienia_pozycje zp
                     LEFT JOIN zamowienia z on zp.id_ezamowienia = z.id_ezamowienia
                     LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
                     LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
            WHERE 0 = 0
        ";
        if ($id_product) {
            $query .= "AND id_artykulu = '" . $id_product . "'";
        }

        if ($id_group) {
            $query .= "AND kg.id_grupy = '" . $id_group . "'";
        }
        if ($from) {
            $query .= " AND z.data_zlozenia >= CAST('" . $from . "' AS DATE)";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= CAST('" . $to . "' AS DATE)";
        }
        $query .= " 
            GROUP BY kg.id_grupy
            ORDER BY wartosc_zamowien_netto DESC;
        ";
        dump($query);
        return $clientGroup = $this->connection->fetchAll($query);
    }

    public function getGroup($id_group = null, $from = null, $to = null, $id_client = null)
    {
        $query = "
            SELECT
                z.id_kontrahenta id_kontrahenta,
                IFNULL(k.nazwa_kontrahenta, 'Brak nazwy kontrahenta') nazwa_kontrahenta,
                kg.id_grupy id_grupy,
                kg.nazwa_grupy nazwa_grupy,
                COUNT(distinct  zp.id_ezamowienia) ilosc_zamowien,
                SUM(zp.cena_netto * zp.ilosc) wartosc_netto,
                SUM(zp.cena_brutto * zp.ilosc) wartosc_brutto
            FROM zamowienia_pozycje zp
                    LEFT JOIN zamowienia z on z.id_ezamowienia = zp.id_ezamowienia
                     LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
                     LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
        ";
        if ($id_group == -1) {
            $query .= "
                WHERE k.id_kontrahenta is null  AND kg.id_grupy is null
                ";
        } else {
            $query .= "
                WHERE kg.id_grupy IN ('" . $id_group . "')";
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
        dump($query);
        return $this->connection->fetchAll($query);
    }

    public function getGroupsOrder($id_product, $id_groups = array(), $from = null, $to = null)
    {
        $query = "
            SELECT
                z.id_kontrahenta id_kontrahenta,
                IFNULL(k.nazwa_kontrahenta, 'Brak nazwy kontrahenta') nazwa_kontrahenta,
                kg.id_grupy id_grupy,
                kg.nazwa_grupy nazwa_grupy,
                COUNT(distinct  zp.id_ezamowienia) ilosc_zamowien,
                SUM(zp.cena_netto * zp.ilosc) wartosc_netto,
                SUM(zp.cena_brutto * zp.ilosc) wartosc_brutto
            FROM zamowienia_pozycje zp
                    LEFT JOIN zamowienia z on z.id_ezamowienia = zp.id_ezamowienia
                    LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
                    LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
        ";
        if ($id_product) {
            $query .= "
                WHERE zp.id_artykulu IN (" . $id_product . ")
                ";
        }
        if ($id_groups) {

            $id_groups = implode(",", $id_groups);
            $query .= " AND kg.id_grupy  IN (" . $id_groups . ")
            ";
        }
        if ($from) {
            $query .= " AND z.data_zlozenia >= CAST('" . $from . "' AS DATE)
            ";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= CAST('" . $to . "' AS DATE)
            ";
        }
        $query .= " GROUP BY id_kontrahenta";
        dump($query);
        return $this->connection->fetchAll($query);
    }


}
