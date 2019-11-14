<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

class ProductSale

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
    public function getData($id_product)
    {
        $query = "
            SELECT
                a.nazwa_artykulu product_name,
                SUM(ilosc) quntity,
                COUNT(id_ezamowienia_pozycje) number_of_orders,
                SUM(cena_netto *ilosc) net_sum,
                SUM(cena_brutto * ilosc) gross_sum,
                a.id_ekategorii id_category,
                e.nazwa_kategorii category_name, 
                e.id_ojca id_parent,
                IFNULL(s.nazwa_kategorii, e.nazwa_kategorii) main_category_name
            FROM zamowienia_pozycje zp
            LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
            LEFT JOIN ekategorie e on a.id_ekategorii = e.id_kategorii
            LEFT JOIN
                 (
                     SELECT id_kategorii, id_ojca, nazwa_kategorii
                     FROM ekategorie
                 ) s on e.id_ojca = s.id_kategorii
            WHERE zp.id_artykulu = '" . $id_product . "'
                ";

        dump($query);

        return $orderGroupOrders = $this->connection->fetchAll($query);
    }
}