<?php

namespace App\Controller;

use App\Entity\Artykuly;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
                ");

        $arr = [
            ['Nr zamówienia / kontrahent', 'Wartość zamowienia netto']
        ];
        if ($orders) {
            foreach ($orders as $order) {
                $arr[] = [
                    $order['numer_zamowienia'] . " / " . $order['nazwa_kontrahenta'], floatval($order['wartosc_netto'])
                ];
            }
        }


        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable($arr);
        $pieChart->getOptions()->setTitle('');
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

        if ($orderMax) {
            $arr = [
                ['Kontrahent', 'Wartość zamowień netto']
            ];
            foreach ($orderMax as $order) {

                $arr[] = [
                    $order['nazwa_kontrahenta'],
                    floatval($order['laczna_wartosc_netto'])
                ];
            }
        }

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable($arr);
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
     * @Route("/client_group",  name="analysis_client_group")
     */
    public function clientGroup(Request $request)
    {
        $title = "Wartość zamówień netto według grup klientów";

        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));
        $group = htmlspecialchars($request->query->get("group"));

        $query = "
                SELECT k.id_grupy,
                       kg.nazwa_grupy,
                       count(k.id_grupy) ilosc_w_grupie,
                       sum(z.wartosc_netto) wartosc_zamowien_netto,
                       sum(z.wartosc_brutto) wartosc_zamowien_brutto
                FROM kontrahenci k
                         LEFT JOIN kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
                         LEFT JOIN zamowienia z on k.id_kontrahenta = z.id_kontrahenta
                WHERE czy_aktywny = 1                  
        ";
        $qexample = "SELECT 
                        k.id id,
                        nazwa_skrocona,
                        nazwa_kontrahenta,
                        sum(wartosc_netto)  laczna_wartosc_netto,
                        sum(wartosc_brutto) laczna_wartosc_brutto
                 FROM zamowienia z
                         LEFT JOIN kontrahenci k on z.id_kontrahenta = k.id_kontrahenta
                 WHERE czy_aktywny = 1
                 GROUP BY z.id_kontrahenta
                 ORDER BY laczna_wartosc_netto desc";
        if ($group) {
            $query .= "AND kg.nazwa_grupy = '". $group . "'";
        }

        if ($from) {
            $query .= " AND z.data_zlozenia > CAST('" . $from . "' AS DATE)";
        }

        if ($to) {
            $query .= " AND z.data_zlozenia < CAST('" . $to . "' AS DATE)";
        }
        $query .= " GROUP BY k.id_grupy ORDER BY wartosc_zamowien_netto DESC";

        $clientGroup = $this->connection->fetchAll($query);

        // Syma wartości zamówień netto

        $sumNet = 0;

        foreach ($clientGroup as $item) {
            $sumNet += $item["wartosc_zamowien_netto"];
        }
//        dump($sumGross);die();
        // Zapełenie danych do PieChart

        if ($clientGroup) {
            $arr = [
                ['Nazwa grupy', 'Ilość kontrahentów w grupie', 'Wartość zamówień netto'],
            ];

            foreach ($clientGroup as $client) {
                $arr[] = [
                    $client['nazwa_grupy'],
                    floatval($client['ilosc_w_grupie']),
                    floatval($client['wartosc_zamowien_netto'])
                ];
            }
        } else {
            die("brak danych dla podanego zakresu");
        }

        if ($clientGroup) {
            $arr2 = [
                ['Nazwa grupy', 'Wartość zamówień netto'],
            ];
            foreach ($clientGroup as $client) {
                $arr2[] = [
                    $client['nazwa_grupy'],

                    floatval($client['wartosc_zamowien_netto'])
                ];
            }
        } else {
            die("Brak danych dla podanego zakresu");
        }

        // Koniec zapełniania danych do Pie Chart

        // Konfiguracja pie charts

        $chart = new BarChart();
        $chart->getData()->setArrayToDataTable($arr);
        $chart->getOptions()->getChart()
            ->setTitle('Ilość kontrhentów w grupie')
            ->setSubtitle('łaczna wartość zamówień netto');
        $chart->getOptions()
            ->setHeight(700)
            ->setWidth(1100)
            ->setSeries([['axis' => 'value'], ['axis' => 'quantity']])
            ->setAxes(['x' => [
                'value' => ['label' => 'łaczna wartość zamówień netto'],
                'quantity' => ['side' => 'top', 'label' => 'ilość kontrahentów w grupie']]
            ]);

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable($arr);
        $pieChart->getOptions()->setTitle($title);
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(700);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        $title2 = 'Wartośc zamówień netto w grupie';
        $pieChart2 = new PieChart();
        $pieChart2->getData()->setArrayToDataTable($arr2);
        $pieChart2->getOptions()->setTitle($title2);
        $pieChart2->getOptions()->setHeight(500);
        $pieChart2->getOptions()->setWidth(700);
        $pieChart2->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart2->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart2->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart2->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart2->getOptions()->getTitleTextStyle()->setFontSize(20);


        // Dane do widoku twig

        return $this->render('analysis/client-group.html.twig', [
            'client_group' => $clientGroup,
            'bar_chart' => $chart,
            'pie_chart' => $pieChart,
            'pie_chart2' => $pieChart2,
            'title' => $title,
            'from' => $from,
            'to' => $to,
            'group' => $group,
            'sum_net' => $sumNet

        ]);
    }

    /**
     * @Route("/order_product_group", name="analysis_order_product_group")
     */
    public function order_product_group()
    {

    }

}
