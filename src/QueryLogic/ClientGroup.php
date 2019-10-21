<?php


namespace App\QueryLogic;


class ClientOrder
{
    public function getData($group, $from, $to)
    {
        $query = "
                SELECT k.id_grupy,
                       kg.nazwa_grupy,
                       count(k.id_grupy) ilosc_w_grupie,
                       sum(z.wartosc_netto) wartosc_zamowien_netto,
                       sum(z.wartosc_brutto) wartosc_zamowien_brutto
                FROM kontrahenci k
                         LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
                         LEFT JOIN zamowienia z on k.id_kontrahenta = z.id_kontrahenta                
        ";

        if ($group) {
            $query .= "AND kg.nazwa_grupy = '" . $group . "'";
        }

        if ($from) {
            $query .= " AND z.data_zlozenia >= CAST('" . $from . "' AS DATE)";
        }

        if ($to) {
            $query .= " AND z.data_zlozenia <= CAST('" . $to . "' AS DATE)";
        }
        $query .= " GROUP BY k.id_grupy ORDER BY wartosc_zamowien_netto DESC";

        return $clientGroup = $this->connection->fetchAll($query);
    }
}