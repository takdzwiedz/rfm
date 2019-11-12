<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

class ClientUser
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
     * Lista wszystkich Uzytkowników u danego kontrahenta
     * @param $id_client
     * @param null $id_user
     * @return mixed[]
     */
    public function getData($id_client, $id_user = null)
    {
        $query =
            "
            SELECT ua.id_auth,
                   ua.imie_nazwisko,
                   ua.username,
                   ua.imie_nazwisko,
                   uaf.id_firmy,
                   k.nazwa_kontrahenta
            FROM user_auth ua
                     LEFT JOIN user_auth_firmy uaf ON ua.id_auth = uaf.id_auth
                     LEFT JOIN kontrahenci k ON k.id_kontrahenta = uaf.id_firmy
            WHERE uaf.id_firmy = '" . $id_client . "'
        ";

        if ($id_user) {
            $query .=
                "
                AND ua.id_auth = '" . $id_user . "'";
        }
        $query .=
            "
             AND ua.id_auth IN
                    (
                        SELECT id_auth
                        FROM user_auth_firmy
                                 INNER JOIN kontrahenci ON user_auth_firmy.id_firmy = kontrahenci.id_kontrahenta
                        WHERE id_kontrahenta = '" . $id_client . "'
                        ";
        if ($id_user) {
            $query .=
                "
                AND id_auth = '" . $id_user . "'";
        }
        $query .=
            "
                    )
                OR ua.id_auth IN
                    (
                        SELECT id_auth
                        FROM zamowienia
                        WHERE id_kontrahenta = '" . $id_client . "'";

        if ($id_user) {
            $query .=
                "
                AND id_auth = '" . $id_user . "'";
        }
        $query .=
            " 
                    )
            ";


//        dump($query);
        return $this->connection->fetchAll($query);
    }

    public function getUserClientOrder($id_client, $id_user, $from = null, $to = null)
    {
        $query = "
            SELECT 
                id_ezamowienia,
                id_zamowienia,
               id_kontrahenta,
               numer_zamowienia,
               data_zlozenia,
               godzina_zlozenia,
               data_realizacji,
               priorytet,
               auto_rezerwacja,
               wartosc_brutto,
               wartosc_netto,
               stan,
               status_zamowienia,
               tryb,
               narzut,
               czy_powiadom,
               id_auth,
               status_wfmag,
               id_wfmag_user,
               id_firmy,
               zam_wartosc_rabat,
               zam_znak_rabat,
               status_ecommerce,
               rabat_kontrahenta,
               id_magazynu,
               session_id,
               id_platnosci,
               czy_faktura,
               uwagi,
               uwagi_klienta,
               uwagi_wysylka,
               rodzaj_zamowienia,
               id_auth_akceptacja,
               id_adresu,
               id_kontaktu,
               token,
               data_akceptacji,
               id_jednostki,
               id_dzialu,
               id_dane_faktury,
               numer_wfmag,
               id_zaakceptowal,
               id_pakietu
        FROM zamowienia
        WHERE id_kontrahenta = '" . $id_client . "'
        AND id_auth = '" . $id_user . "'
        ";
        if ($from) {
            $query .= " AND data_zlozenia >= CAST('" . $from . "' AS DATE)";
        }
        if ($to) {
            $query .= " AND data_zlozenia <= CAST('" . $to . "' AS DATE)";
        }

        return $this->connection->fetchAll($query);
    }

    public function getClientUserOrderDetail($id_client, $id_user, $from = null, $to = null)
    {
        $query = "
            SELECT z.id_auth,
                   ua.imie_nazwisko,
                   COUNT(z.id_ezamowienia) order_total_number,
                   SUM(z.wartosc_netto) order_total_net_sum,
                   SUM(z.wartosc_brutto) order_total_gross_sum,
                   k.id_kontrahenta id_client,
                   k.nazwa_kontrahenta client_name,
                   k.id_grupy id_group,
                   kg.nazwa_grupy group_name
            FROM zamowienia z
            LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
            LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
            LEFT JOIN user_auth_firmy uaf on z.id_auth = uaf.id_auth
            LEFT JOIN user_auth ua on uaf.id_auth = ua.id_auth
        WHERE z.id_kontrahenta = '" . $id_client . "'
        AND z.id_auth = '" . $id_user . "'
        ";

        if ($from) {
            $query .= " AND z.data_zlozenia >= CAST('" . $from . "' AS DATE)";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= CAST('" . $to . "' AS DATE)";
        }

        return $this->connection->fetchAll($query);
    }
}
