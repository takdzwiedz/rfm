<?php

namespace App\Controller;

use App\Entity\Artykuly;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnalysisController extends AbstractController
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(
        Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Tu powstanie moduł analiz');
    }

    /**
     * @Route("/article/{id}", name="article_show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Artykuly::class)
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                "Nie ma artykułu o id: " . $id
            );
        }

        return $this->render('analysis/article.html.twig', [
            'article_name' => $article->getNazwaArtykulu()
        ]);
    }

    /**
     * @Route("/order", name="analysis_order")
     * @return Response
     */
    public function order()
    {
        $title = 'Analiza zamówień';

        $orders = $this->connection->fetchAll(
            "SELECT 
                    numer_zamowienia,
                    k.nazwa_kontrahenta,
                    data_zlozenia,
                    wartosc_netto,
                    wartosc_brutto
                FROM zamowienia
                LEFT JOIN kontrahenci k on zamowienia.id_kontrahenta = k.id_kontrahenta
                ORDER BY wartosc_netto DESC
                LIMIT 10");


        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Nr zamówienia / kontrahent', 'Wartość zamowienia netto'],
                [$orders[0]['numer_zamowienia'] . " / " . $orders[0]['nazwa_kontrahenta'], floatval($orders[0]['wartosc_netto'])],
                [$orders[1]['numer_zamowienia'] . " / " . $orders[1]['nazwa_kontrahenta'], floatval($orders[1]['wartosc_netto'])],
                [$orders[2]['numer_zamowienia'] . " / " . $orders[2]['nazwa_kontrahenta'], floatval($orders[2]['wartosc_netto'])],
                [$orders[3]['numer_zamowienia'] . " / " . $orders[3]['nazwa_kontrahenta'], floatval($orders[3]['wartosc_netto'])],
                [$orders[4]['numer_zamowienia'] . " / " . $orders[4]['nazwa_kontrahenta'], floatval($orders[4]['wartosc_netto'])],
                [$orders[5]['numer_zamowienia'] . " / " . $orders[5]['nazwa_kontrahenta'], floatval($orders[5]['wartosc_netto'])],
                [$orders[6]['numer_zamowienia'] . " / " . $orders[6]['nazwa_kontrahenta'], floatval($orders[6]['wartosc_netto'])],
                [$orders[7]['numer_zamowienia'] . " / " . $orders[7]['nazwa_kontrahenta'], floatval($orders[7]['wartosc_netto'])],
                [$orders[8]['numer_zamowienia'] . " / " . $orders[8]['nazwa_kontrahenta'], floatval($orders[8]['wartosc_netto'])],
                [$orders[9]['numer_zamowienia'] . " / " . $orders[9]['nazwa_kontrahenta'], floatval($orders[9]['wartosc_netto'])]
            ]
        );
        $pieChart->getOptions()->setTitle('Najwieksze zamowienia');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render(
            'analysis/order.html.twig', [
                'orders' => $orders,
                'title' => $title,
                'piechart' => $pieChart
            ]
        );
    }

    /**
     * @Route("/order_max", name="analysis_order_max")
     */
    public function orderMax()
    {

        $title = 'Klienci o najwyżeszej wartości zamówień w PLN';

        $orderMax = $this->connection->fetchAll(
            "SELECT 
                        k.id id,
                        nazwa_skrocona,
                        nazwa_kontrahenta,
                        sum(wartosc_netto)  laczna_wartosc_netto,
                        sum(wartosc_brutto) laczna_wartosc_brutto
                 FROM zamowienia z
                         LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
                 WHERE czy_aktywny = 1
                 GROUP BY z.id_kontrahenta
                 ORDER BY laczna_wartosc_netto desc"
        );

        $tmp = 0;
        $count = 0;
        foreach ($orderMax as $row) {
            $count += 1;
            if ($count > 9) {
                $tmp += $row['laczna_wartosc_netto'];
            }
        }
        $sumRest = floatval($tmp);

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Kontrahent', 'Wartość zamowień netto'],
                [$orderMax[0]['nazwa_kontrahenta'], floatval($orderMax[0]['laczna_wartosc_netto'])],
                [$orderMax[1]['nazwa_kontrahenta'], floatval($orderMax[1]['laczna_wartosc_netto'])],
                [$orderMax[2]['nazwa_kontrahenta'], floatval($orderMax[2]['laczna_wartosc_netto'])],
                [$orderMax[3]['nazwa_kontrahenta'], floatval($orderMax[3]['laczna_wartosc_netto'])],
                [$orderMax[4]['nazwa_kontrahenta'], floatval($orderMax[4]['laczna_wartosc_netto'])],
                [$orderMax[5]['nazwa_kontrahenta'], floatval($orderMax[5]['laczna_wartosc_netto'])],
                [$orderMax[6]['nazwa_kontrahenta'], floatval($orderMax[6]['laczna_wartosc_netto'])],
                [$orderMax[7]['nazwa_kontrahenta'], floatval($orderMax[7]['laczna_wartosc_netto'])],
                [$orderMax[8]['nazwa_kontrahenta'], floatval($orderMax[8]['laczna_wartosc_netto'])],
                ['Reszta', $sumRest]
            ]
        );
        $pieChart->getOptions()->setTitle($title);
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('analysis/order-max.html.twig', [
            'order_max' => $orderMax,
            'title' => $title,
            'piechart' => $pieChart
        ]);
    }

    /**
     * @Route("/client", name="analysis_client" )
     */
    public function client()
    {
        $title = "Aktywni klienci";

        $clients = $this->connection->fetchAll(
            "
            SELECT 
                k.id id,
                kg.nazwa_grupy nazwa_grupy,
                k.nazwa_skrocona nazwa_skrocona,
                k.nip nip,
                k.nazwa_kontrahenta nazwa_kontrahenta
            FROM kontrahenci k
            LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
            WHERE czy_aktywny = 1
            "
        );
        return $this->render('analysis/client.html.twig', [
            'clients' => $clients,
            'title' => $title
        ]);
    }

    /**
     * @Route("/client_group", name="analysis_client_group")
     */
    public function clientGroup()
    {
        $title = "Ilość klientów w grupie";

        $client_group = $this->connection->fetchAll(
            "
                SELECT k.id_grupy,
                       kg.nazwa_grupy,
                       count(k.id_grupy) ilosc_w_grupie,
                       sum(z.wartosc_netto) wartosc_zamowien_netto,
                       sum(z.wartosc_brutto) wartosc_zamowien_brutto
                FROM kontrahenci k
                         LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
                         LEFT JOIN zamowienia z on k.id_kontrahenta = z.id_kontrahenta
                WHERE czy_aktywny = 1
                GROUP BY k.id_grupy
                ORDER BY ilosc_w_grupie DESC            
            "
        );

        return $this->render('analysis/client-group.html.twig', [
            'client_group' => $client_group,
            'title' => $title
        ]);
    }
}
