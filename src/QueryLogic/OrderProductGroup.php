<?php


namespace App\Service;


use Doctrine\DBAL\Connection;

class OrderProductGroup
{

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    public function getData($product, $category, $from, $to)
    {
        $query = "
            SELECT
                   zp.id_artykulu as id_artykulu,
                   a.nazwa_artykulu as nazwa_artykulu,
                   e.nazwa_kategorii as nazwa_kategorii,
                   SUM(zp.ilosc) as ilosc_sprzedanych_produktow,
                   SUM(zp.cena_netto * zp.ilosc) as suma_netto_sprzedanych_produktow
            FROM zamowienia_pozycje zp
            LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
            LEFT JOIN ekategorie e on a.id_ekategorii = e.id_kategorii
            LEFT JOIN zamowienia z on zp.id_ezamowienia = z.id_ezamowienia
            WHERE a.id_artykulu > 0

        ";
        if ($product) {
            $query .= " AND nazwa_artykulu = '" . $product . "' ";
        }

        if($category) {
            $query .= " AND nazwa_kategorii = '" . $category ."'";
        }

        if($from) {
            $query .= " AND z.data_zlozenia >= '" . $from ."'";
        }

        $query .= "
            GROUP BY id_artykulu
            ORDER BY nazwa_kategorii ASC
       ";

        return $orderProductGroup = $this->connection->fetchAll($query);
    }

}