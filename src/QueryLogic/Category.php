<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

class Category
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
    public function getData()
    {
        $query = "
            SELECT id_kategorii,
                   update_person_id,
                   create_person_id,
                   publication_state_id,
                   p_catalog_id,
                   id_ojca,
                   nazwa_kategorii,
                   publication_date_from,
                   publication_date_to,
                   publication_always,
                   photo_url_th,
                   photo_url,
                   active,
                   sort,
                   html_desc,
                   creation_date,
                   update_date,
                   lft,
                   rgt,
                   locale_id,
                   html_desc_short,
                   links,
                   slider,
                   some_parent_inactive,
                   extra1,
                   extra2,
                   seo_title,
                   seo_description,
                   seo_keywords,
                   id_kategorii_wfmag,
                   czy_widoczna,
                   zdjecie,
                   opis
            FROM ekategorie
            WHERE id_ojca = 0
        ";
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }

    /**
     * @param $id_category
     * @return mixed[]
     */
    public function getCategoryDetail($id_category)
    {
        $query = "
            SELECT id_kategorii id_category,
                   nazwa_kategorii category_name
            FROM ekategorie
            WHERE id_kategorii = '". $id_category ."'
        ";
        return $orderGroupOrders = $this->connection->fetchAll($query);
    }

    /**
     * @param $id_parent
     * @param $id_category
     * @param null $from
     * @param null $to
     * @return mixed[]
     */

    public function getCategoryData($id_parent, $id_category, $from = null, $to = null)
    {
        $query = "
            SELECT  IFNULL(e.id_kategorii, 'Produkty nieskategoryzowane')                                   as id_category,
                    IFNULL(e.id_ojca, 'Produkty bez id ojca')                                               as id_parent,
                    IFNULL(e.nazwa_kategorii, 'Produkty nieskategoryzowane')                                as category_name,
                    IFNULL(ifnull(s.nazwa_kategorii, e.nazwa_kategorii), 'Produkty nieskategoryzowane')     as main_category_name,
                    SUM(zp.ilosc)                                                                           as quantity,
                    SUM(zp.cena_netto * zp.ilosc)                                                           as net_sum,
                    SUM(zp.cena_brutto * zp.ilosc)                                                          as gross_sum
            FROM zamowienia_pozycje zp
                     LEFT JOIN artykuly a on zp.id_artykulu = a.id_artykulu
                     LEFT JOIN ekategorie e on a.id_ekategorii = e.id_kategorii
                     LEFT JOIN zamowienia z on zp.id_ezamowienia = z.id_ezamowienia
                     LEFT JOIN (SELECT id_kategorii, id_ojca, nazwa_kategorii FROM ekategorie) s on e.id_ojca = s.id_kategorii
            WHERE z.id_ezamowienia >= 0
            
        ";

        if ($id_parent == 0 && $id_category == 0) {
            $query .=
                "
                    AND e.id_ojca  is null
                    AND e.id_kategorii  is null
                ";
        } elseif ($id_parent == 0 && $id_category != 0) {
            $query .=
                "
                AND e.id_ojca = '" . $id_parent . "'
                AND e.id_kategorii = '" . $id_category . "'
                ";
        } else {
            $query .=
                "
                AND e.id_ojca = '" . $id_parent . "'
                ";
        }

        if ($from) {
            $query .= " AND z.data_zlozenia >= '" . $from . "'";
        }
        if ($to) {
            $query .= " AND z.data_zlozenia <= '" . $to . "'";
        }

        $query .= "
            GROUP BY e.id_kategorii
            ORDER BY net_sum DESC;
        ";
        dump($query);
        return $orderSubGroup = $this->connection->fetchAll($query);
    }

}
