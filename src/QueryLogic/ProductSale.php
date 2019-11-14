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
               SUM(ilosc) quntity,
               COUNT(id_ezamowienia_pozycje) number_of_orders,
               SUM(cena_netto *ilosc) net_sum,
               SUM(cena_brutto * ilosc) gross_sum
        FROM zamowienia_pozycje
        WHERE id_artykulu = '" . $id_product . "'
                ";
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }
}