<?php


namespace App\QueryLogic;


use Doctrine\DBAL\Connection;

class ProductSubcategory
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
    public function getData($id_category)
    {
        $query = "
            SELECT id_artykulu,
               indeks_artykulu,
               indeks_katalogowy,
               nazwa_artykulu,
               id_ekategorii,
               stawka_vat,
               jednostka,
               jednostka_oryg,
               jednostka_wfmag,
               stan,
               czy_widoczny,
               czy_dostepny,
               czy_usuniety,
               czy_gratis,
               czy_nagroda,
               id_artykulu_wfmag,
               id_artykulu_prod,
               id_kategorii,
               minimalna_ilosc,
               opakowanie_zbiorcze,
               czy_usluga,
               kolejnosc,
               id_ceny_domyslnej,
               id_magazynu,
               id_zamiennika,
               cena_zakupu_netto,
               kod_ean,
               ost_aktualizacja,
               czy_zaktualizowano_temp,
               cena_zakupu_brutto,
               data_dodania,
               wyswietlen,
               stan_minimalny,
               czy_zdjecie,
               punkty_nagroda,
               pochodzenie,
               indeks_obcy,
               indeks_wfmag,
               podziel_cene_import,
               cena_import,
               czy_cena_wfmag,
               czy_jedn_wfmag,
               id_kategorii_program,
               p_core_id,
               id_artykulu_honeti,
               data_dostawy,
               nazwa_pelna,
               cykl_zycia,
               id_artykulu_grupuj,
               nazwa_artykulu_grupuj
            FROM artykuly 
            WHERE id_ekategorii = '". $id_category ."'
        ";

        return $orderGroupOrders = $this->connection->fetchAll($query);
    }
}
