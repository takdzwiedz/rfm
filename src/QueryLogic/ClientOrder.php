<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

class ClientOrder
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getData($id_client, $from = null, $to = null)
    {
        $query = "
            SELECT ua.id_auth id_user,
                   ua.imie_nazwisko name_surname,
                   k.id_kontrahenta id_client,
                   k.nazwa_kontrahenta client_name,
                   kg.id_grupy id_group,
                   kg.nazwa_grupy group_name,
                   sum(z.wartosc_netto) net_sum,
                   sum(z.wartosc_brutto) gross_sum,
                   COUNT(z.id_ezamowienia) order_quantity
            FROM zamowienia z
            LEFT JOIN kontrahenci k ON k.id_kontrahenta = z.id_kontrahenta
            LEFT JOIN user_auth_firmy uaf on z.id_auth = uaf.id_auth
            LEFT JOIN user_auth ua on uaf.id_auth = ua.id_auth
            LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
            ";

        if ($id_client) {
            $query .= " WHERE k.id_kontrahenta = '" . $id_client . "'";
        }
        if ($from) {
            $query .= " AND z.data_zlozenia >= CAST('" . $from . "' AS DATE)";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= CAST('" . $to . "' AS DATE)";
        }
        $query .= "GROUP BY ua.id_auth ORDER BY order_quantity DESC";
//        dump($query);
        return $this->connection->fetchAll($query);
    }
}
