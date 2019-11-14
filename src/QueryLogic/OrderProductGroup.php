<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

/**
 * Class OrderProductGroup
 * @package App\QueryLogic
 *
 * Lista kategorii głównych, ilości sprzedanych produktów i ich wartości
 */
class OrderProductGroup
{

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getParentData($from = null, $to = null)
    {
        $query = "
        SELECT
               e.id_ojca                                       id_ojca,
               e.id_kategorii                                  id_kategorii,
               IFNULL(IFNULL(s.nazwa_kategorii, e.nazwa_kategorii), 'Brak przyporządkowanej kategorii') as nazwa_kategorii,
               SUM(zp.ilosc)                                as ilosc_sprzedanych_produktow,
               SUM(zp.cena_netto * zp.ilosc)                as suma_netto_sprzedanych_produktow
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
            GROUP BY IF(e.id_ojca = 0, id_ekategorii, e.id_ojca)
            ORDER BY suma_netto_sprzedanych_produktow DESC;
       ";
        dump($query);
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }

    public function getChildrenData($category = null, $from = null, $to = null)
    {
        $query = "
            SELECT e.id_kategorii                                  id_kategorii,
                   e.id_ojca                                       id_ojca,
                   e.nazwa_kategorii                            as nazwa_kategorii,
                   ifnull(s.nazwa_kategorii, e.nazwa_kategorii) as nazwa_kategorii_glownej,
                   SUM(zp.ilosc)                                as ilosc_sprzedanych_produktow,
                   SUM(zp.cena_netto * zp.ilosc)                as suma_netto_sprzedanych_produktow
            FROM zamowienia_pozycje zp
                     LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
                     LEFT JOIN ekategorie e on a.id_ekategorii = e.id_kategorii
                     LEFT JOIN zamowienia z on zp.id_ezamowienia = z.id_ezamowienia
                     LEFT JOIN (SELECT id_kategorii, id_ojca, nazwa_kategorii FROM ekategorie) s on e.id_ojca = s.id_kategorii
            WHERE e.id_ojca >= 0
        ";

        if ($category) {
            $query .= " AND s.nazwa_kategorii  = '" . $category . "' OR e.nazwa_kategorii = '" . $category . "'";
        }

        if ($from) {
            $query .= " AND z.data_zlozenia >= '" . $from . "'";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= '" . $from . "'";
        }

        $query .= "
            GROUP BY e.id_kategorii
            ORDER BY suma_netto_sprzedanych_produktow DESC;
        ";
dump($query);
        return $orderSubGroup = $this->connection->fetchAll($query);
    }

    /**
     * @return Connection
     */
    public function getGrandChildrenData()
    {
        
    }

}
