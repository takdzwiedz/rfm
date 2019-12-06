<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Driver\Connection;

class Product
{

    /**
     * @var Connection
     */
    private $Connection;

    public function __construct(Connection $Connection)
    {
        $this->Connection = $Connection;
    }

    public function search($value)
    {
        $query = "
            SELECT *, e.id_ojca, e.id_kategorii
            FROM artykuly a
            LEFT JOIN ekategorie e on a.id_ekategorii = e.id_kategorii
            WHERE a.nazwa_artykulu LIKE :product_name";
        $stmt = $this->Connection->prepare($query);
        $stmt->execute([
            ':product_name' => "%" . $value . "%",

        ]);
        dump($query);
        return $stmt->fetchAll();
    }

    public function productOrderDetail($id_product, $from = null, $to = null, $id_group = null)
    {
        $query = "
            SELECT z.id_ezamowienia               id_order,
                   z.numer_zamowienia             order_number,       
                   z.id_auth                      id_user,
                   ua.imie_nazwisko               user_name,
                   z.id_kontrahenta               id_client,
                   z.data_zlozenia                order_date,
                   k.nazwa_kontrahenta            client_name,
                   kg.id_grupy                    id_group,
                   kg.nazwa_grupy                 group_name,
                   zp.ilosc                       quantity,
                   sum(zp.cena_netto * zp.ilosc)  net_sum,
                   sum(zp.cena_brutto * zp.ilosc) gross_sum
            
            FROM zamowienia_pozycje zp
                     LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
                     LEFT JOIN zamowienia z on z.id_ezamowienia = zp.id_ezamowienia
                     LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
                     LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
                     LEFT JOIN user_auth ua on ua.id_auth = z.id_auth

            ";
        if ($from and $to == null) {
            $query .= "
                    WHERE zp.id_artykulu = '" . $id_product . "'
                    AND CAST(z.data_zlozenia AS DATE) >= CAST('" . $from . "' AS DATE)
                ";
        } elseif ($from == null and $to) {
            $query .= "
                    WHERE zp.id_artykulu = '" . $id_product . "'
                    AND CAST(z.data_zlozenia AS DATE) <= CAST('" . $to . "' AS DATE)
                ";
        } elseif ($from and $to) {
            $query .= "
                    WHERE zp.id_artykulu = '" . $id_product . "'
                    AND CAST(z.data_zlozenia AS DATE) >= CAST('" . $from . "' AS DATE)
                    AND CAST(z.data_zlozenia AS DATE) <= CAST('" . $to . "' AS DATE)
                ";
        } else {
            $query .= "
                WHERE zp.id_artykulu = '" . $id_product . "' OR zp.id_artykulu = 9585 and z.data_zlozenia is null
                ";
        }
        if ($id_group) {
            $query .= "
                AND kg.id_grupy ='" . $id_group . "'
                ";
        }

        $query .= "
            GROUP BY z.id_ezamowienia
            ORDER BY net_sum DESC;
        ";

        dump($query);
        return $this->Connection->fetchAll($query);
    }

}