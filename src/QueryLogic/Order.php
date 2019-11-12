<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

class Order
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
     * Szczegóły konkretnego zamówienia
     */
    public function getData($id_order)
    {
        $query = "
            SELECT zp.id_artykulu            id,
                   a.nazwa_artykulu          product_name,
                   zp.ilosc                  quantity,
                   zp.cena_netto             unit_net_price,
                   zp.cena_brutto            unit_gross_price,
                   zp.cena_netto * zp.ilosc  net_price,
                   zp.cena_brutto * zp.ilosc gross_price
            FROM zamowienia_pozycje zp
                     LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
            WHERE id_ezamowienia = '" . $id_order . "';        
        ";


        return $this->connection->fetchAll($query);
    }

    /**
     * Ogólne informacje o zamówieniu
     */
    public function getOrderDetail($id_order)
    {
        $query = "
        SELECT z.id_auth id_auth,
               ua.imie_nazwisko user_name,
               z.id_ezamowienia order_number,
               z.id_firmy id_client,
               k.nazwa_kontrahenta client_name,
               kg.id_grupy id_group,
               kg.nazwa_grupy group_name,
               z.id_kontrahenta id_client,
               z.wartosc_netto  net_price,
               z.wartosc_brutto gross_price
        FROM zamowienia z
                LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
                LEFT JOIN computer_test.user_auth ua on z.id_auth = ua.id_auth
                LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
        WHERE id_ezamowienia = '" . $id_order . "'
        ";

        dump($query);
        return $this->connection->fetchAll($query);
    }
}