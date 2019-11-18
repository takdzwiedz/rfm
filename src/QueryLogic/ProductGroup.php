<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

class ProductGroup
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
     * @param null $from
     * @param null $to
     * @return mixed[]
     */
    public function getData($from = null, $to = null)
    {
        $query = "
        SELECT
               e.id_ojca                                                                                as id_parent,
               e.id_kategorii                                                                           as id_category,
               IFNULL(IFNULL(s.nazwa_kategorii, e.nazwa_kategorii), 'Produkty nieskategoryzowane') as category_name,
               SUM(zp.ilosc)                                                                            as quantity,
               SUM(zp.cena_netto * zp.ilosc)                                                            as sum_net,
               SUM(zp.cena_brutto * zp.ilosc)                                                           as sum_gross
        FROM zamowienia_pozycje zp
                 LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
                 LEFT JOIN ekategorie e on a.id_ekategorii = e.id_kategorii
                 LEFT JOIN zamowienia z on zp.id_ezamowienia = z.id_ezamowienia
                 LEFT JOIN (SELECT id_kategorii, id_ojca, nazwa_kategorii FROM ekategorie) s on e.id_ojca = s.id_kategorii
        WHERE a.id_kategorii > 0    
        ";

        if ($from) {
            $query .= " AND z.data_zlozenia >= '" . $from . "'";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= '" . $from . "'";
        }

        $query .= "
             GROUP BY CASE
                 WHEN e.id_ojca = 0 THEN id_ekategorii
                 ELSE e.id_ojca
                 END
             ORDER BY sum_net    DESC;
       ";

        dump($query);
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }
}