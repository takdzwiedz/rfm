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
     * @param $id_product
     * @param null $from
     * @param null $to
     * @return mixed[]
     */
    public function getData($id_product, $from = null, $to = null)
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
            LEFT JOIN zamowienia z on z.id_ezamowienia = zp.id_ezamowienia
            LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
            LEFT JOIN ekategorie e on a.id_ekategorii = e.id_kategorii
            LEFT JOIN
                 (
                     SELECT id_kategorii, id_ojca, nazwa_kategorii
                     FROM ekategorie
                 ) s on e.id_ojca = s.id_kategorii
            WHERE zp.id_artykulu = '" . $id_product . "'
                ";
        if ($from) {
            $query .= " AND z.data_zlozenia >= CAST('" . $from . "' AS DATE)";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= CAST('" . $to . "' AS DATE)";
        }


        dump($query);
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }

    public function getDataByMonth($id_product = null)
    {
        $query= "
            SELECT 
                   YEAR(data_zlozenia) year, 
                   MONTH(data_zlozenia) month, 
                   MONTH(data_zlozenia) month, 
                   SUM(zp.cena_netto*ilosc) sum
            FROM zamowienia
            INNER JOIN zamowienia_pozycje zp on zamowienia.id_ezamowienia = zp.id_ezamowienia
            WHERE data_zlozenia >= DATE_SUB(now(), INTERVAL 12 MONTH)
            
        ";
        if ($id_product) {
            $query .= "
            AND id_artykulu IN ('".$id_product."')
            ";
        }
        $query .= "
            GROUP BY YEAR(data_zlozenia), MONTH(data_zlozenia)
        ";
        dump($query);
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }


    public function getSaleByMonth($id_product = null)
    {
        $query= "
            
            SELECT YEAR(k.miesiace)  as                                    year,
                   MONTH(k.miesiace) AS                                    month,
                   IFNULL(YEAR(data_zlozenia), YEAR(k.miesiace))           order_year,
                   IFNULL(MONTH(data_zlozenia), MONTH(k.miesiace))         order_month,
                   IFNULL(MONTHNAME(data_zlozenia), MONTHNAME(k.miesiace)) monthname,
                   IFNULL(SUM(zp.cena_netto * ilosc), 0)                   sum
            FROM kalendarz k
                     LEFT OUTER JOIN zamowienia z
                                     on MONTH(z.data_zlozenia) = MONTH(k.miesiace) AND YEAR(z.data_zlozenia) = YEAR(k.miesiace)
                     LEFT OUTER JOIN zamowienia_pozycje zp on z.id_ezamowienia = zp.id_ezamowienia 
                             

        ";
        if ($id_product) {
            $query .= "
            AND zp.id_artykulu IN ('".$id_product."')
            ";
        }
        $query .= "
            WHERE k.miesiace >= DATE_SUB(now(), INTERVAL 12 MONTH)
                  AND k.miesiace <= now()
                GROUP BY MONTH(k.miesiace), YEAR(k.miesiace)
                ORDER BY YEAR(k.miesiace), MONTH(k.miesiace);
        ";
        dump($query);
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }
}