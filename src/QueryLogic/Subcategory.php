<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

class Subcategory
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
     * @return mixed[]
     */
    public function getData($id_parent, $id_subcategory)
    {
        $query = "
            SELECT e.id_kategorii id_category,
                   e.nazwa_kategorii category_name,
                   e.id_ojca id_parent
            FROM ekategorie e
            LEFT JOIN
                (
                SELECT id_kategorii, id_ojca, nazwa_kategorii FROM ekategorie
                ) s on e.id_ojca = s.id_kategorii
            WHERE e.id_ojca = '". $id_parent ."'
        ";
        if($id_parent == 0) {
            $query .=
                "
                AND e.id_kategorii = '". $id_subcategory ."'
                ";
        }
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }

    public function getSubcategoryData($id_subcategory)
    {
        $query =
            "
            SELECT zp.id_artykulu                                     id_product,
                   a.nazwa_artykulu                                   product_name,
                   SUM(zp.ilosc)                                      quantity,
                   FORMAT(SUM(zp.ilosc * zp.cena_netto), 2, 'pl_PL')  net_sum,
                   SUM(zp.ilosc * zp.cena_netto)                      net_sum_op,
                   FORMAT(SUM(zp.ilosc * zp.cena_brutto), 2, 'pl_PL') gross_sum
            FROM zamowienia z
                     LEFT JOIN zamowienia_pozycje zp on z.id_ezamowienia = zp.id_ezamowienia
                     LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
            WHERE a.id_ekategorii = '". $id_subcategory ."'
            GROUP BY zp.id_artykulu
            ORDER BY net_sum_op DESC;
            
            ";

        return $orderGroupOrders = $this->connection->fetchAll($query);
    }

}
