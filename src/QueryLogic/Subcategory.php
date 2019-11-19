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
            WHERE e.id_ojca = '" . $id_parent . "'
        ";
        if ($id_parent == 0) {
            $query .=
                "
                AND e.id_kategorii = '" . $id_subcategory . "'
                ";
        }
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }

    public function getSubcategoryData($id_subcategory, $from = null, $to = null)
    {
        $query =
            "
           SELECT zp.id_artykulu                 id_product,
                   a.nazwa_artykulu               product_name,
                   SUM(zp.ilosc)                  quantity,
                   SUM(zp.ilosc * zp.cena_netto)  net_sum,
                   SUM(zp.ilosc * zp.cena_netto)  net_sum_op,
                   SUM(zp.ilosc * zp.cena_brutto) gross_sum
            FROM zamowienia_pozycje zp
                     LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
            WHERE a.id_ekategorii = '" . $id_subcategory . "'           
            ";

        if ($from) {
            $query .= " AND z.data_zlozenia >= '" . $from . "'";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= '" . $to . "'";
        }

        $query .= "
            GROUP BY zp.id_artykulu
            ORDER BY net_sum_op DESC;
        ";
        dump($query);

        return $orderGroupOrders = $this->connection->fetchAll($query);
    }

    public function getSubcategoryDetail($id_category)
    {
        $query =
            "
            SELECT e.nazwa_kategorii category_name,
                   e.id_ojca id_parent,
                   IFNULL(s.nazwa_kategorii, e.nazwa_kategorii) main_category_name
            FROM ekategorie e
                     LEFT JOIN
                 (
                     SELECT id_kategorii, id_ojca, nazwa_kategorii
                     FROM ekategorie
                 ) s on e.id_ojca = s.id_kategorii
            
            WHERE e.id_kategorii = '" . $id_category . "';
            ";

        dump($query);

        return $orderGroupOrders = $this->connection->fetchAll($query);
    }
}
