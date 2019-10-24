<?php

namespace App\Controller;

use App\Entity\Artykuly;
use App\QueryLogic\Client;
use App\QueryLogic\ClientGroup;
use App\QueryLogic\Group;
use App\QueryLogic\OrderGroup;
use App\QueryLogic\OrderProductGroup;
use App\Service\ChartRender;
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
    public function client(Client $client)
    {
        $title = "Aktywni klienci";

        $clients = $client->getData();

        return $this->render('analysis/client.html.twig', [
            'clients' => $clients,
            'title' => $title
        ]);
    }

    /**
     * @Route("/client_group",  name="analysis_client_group")
     */

    public function clientGroup(
        Request $request,
        ChartRender $chartRender,
        ClientGroup $clientGroup,
        OrderGroup $orderGroup,
        Group $groups
    )
    {
        $titleOrderGroup1 = "Wartość zamówień netto według grup klientów";
        $titleOrderGroup2 = "Wartość zamówień kontrahentów w grupie w wybranym okresie";
        $group = htmlspecialchars($request->query->get("group"));
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));
        $chart = [];
        $pieChart = [];
        $columnChart = [];

        $allGroups = $groups->getData();
        $clientGroup = $clientGroup->getData($group, $from, $to);

        // Syma wartości zamówień netto

        $sumNet = 0;
        foreach ($clientGroup as $item) {
            $sumNet += $item["wartosc_zamowien_netto"];
        }

        $group ? $orderGroup = $orderGroup->getData($group) : $group = [];

        // Zapełenie danych do BarChart

        if ($clientGroup) {
            $barChartData = [
                ['Nazwa grupy', 'Ilość kontrahentów w grupie', 'Wartość zamówień netto'],
            ];
            foreach ($clientGroup as $client) {
                $barChartData[] = [
                    $client['nazwa_grupy'],
                    floatval($client['ilosc_zamowien_w_grupie']),
                    floatval($client['wartosc_zamowien_netto'])
                ];
            }
            $chart = $chartRender->barChart(
                $barChartData,
                'Ilość Kontrhentów w grupie',
                'Łączna wartość zamówień netto',
                'Łączna wartośc zamówień netto',
                'Ilośc kontrahentów w grupie'
            );
            $chart->getOptions()->setColors(['blue', 'orange', 'yellow']);
        }

        // Zapełnianie danych do PieChart
        if ($clientGroup) {
            $pieChartData = [
                ['Nazwa grupy', 'Wartość zamówień netto'],
            ];
            foreach ($clientGroup as $client) {
                $pieChartData[] = [
                    $client['nazwa_grupy'],
                    floatval($client['wartosc_zamowien_netto'])
                ];
            }
            $pieChart = $chartRender->pieChart(
                $pieChartData,
                'Wartość zamówień netto w grupie');
        }
        // Zapełnianie danych do ColumnChart
        if ($group) {
            $columnChartData = [
                ['Nazwa kontrahenta', 'Wartość zamówień netto']
            ];
            foreach ($orderGroup as $client) {
                $columnChartData[] = [
                    $client['nazwa_kontrahenta'],
                    floatval($client['wartosc_netto'])
                ];
            }
            $columnChart = $chartRender->columnChart($columnChartData, 'Wartość zamówień kontrhentów za wybrany okres');
        }


        return $this->render('analysis/client-group.html.twig', [
            'client_group' => $clientGroup,
            'bar_chart' => $chart,
            'pie_chart2' => $pieChart,
            'column_chart' => $columnChart,
            'title_1' => $titleOrderGroup1,
            'title_2' => $titleOrderGroup2,
            'from' => $from,
            'to' => $to,
            'group' => $group,
            'groups' => $allGroups,
            'sum_net' => $sumNet,
            'order_group' => $orderGroup
        ]);
    }

    /**
     * @Route("/order_product_group", name="analysis_order_product_group")
     */
    public function order_product_group(Request $request, OrderProductGroup $orderProductGroup, ChartRender $chartRender)
    {
        $title = "Sprzedaż artykułów w kategoriach";
        $title2 = "Sprzedaż artykułów w podkategoriach";
        $category = htmlspecialchars($request->get("category"));
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));

        $orderGroup = $orderProductGroup->getParentData($from, $to);
        $orderSubGroup = $orderProductGroup->getChildrenData($category, $from, $to);

        $categories = [];

        if ($orderGroup) {

            foreach ($orderGroup as $row) {
                if (!array_search($row["nazwa_kategorii"], $categories)) {
                    $categories[] = $row["nazwa_kategorii"];
                }
            }
        }

        $barChartData = [
            ['Nazwa kategorii', 'Ilość sprzedanych produktów', 'Suma netto sprzedanych produktów']
        ];
        foreach ($orderGroup as $row) {
            $barChartData[] = [
                $row["nazwa_kategorii"],
                floatval($row["ilosc_sprzedanych_produktow"]),
                floatval($row["suma_netto_sprzedanych_produktow"])
            ];
        }

        $barChart = $chartRender->barChart($barChartData,
            'Sprzedaż w kategoriach głównych',
            'Ilość sprzedanych produktów',
            'Suma sprzedaży netto produktów',
            'Ilość sprzedanych produktów');
        $barChart->getOptions()->setColors(['orange', 'green']);

        // Zapełnianie danych do ColumnChart
        $columnChart = [];
        if ($category) {
            $columnChartData = [
                ['Nazwa podkategorii', 'Suma netto sprzedanych produktów']
            ];
            foreach ($orderSubGroup as $client) {
                $columnChartData[] = [
                    $client['nazwa_kategorii'],
                    floatval($client['suma_netto_sprzedanych_produktow'])
                ];
            }
            $columnChart = $chartRender->columnChart($columnChartData, 'Wartość zamówień kontrhentów za wybrany okres');
            $columnChart->getOptions()->setColors('purple');
        }

        return $this->render('analysis/order-product-group.html.twig', [
            'title' => $title,
            'title_2' => $title2,
            'data' => $orderGroup,
            'categories' => $categories,
            'category' => $category,
            'from' => $from,
            'to' => $to,
            'bar_chart' => $barChart,
            'column_chart' => $columnChart,
            'order_sub_groups' => $orderSubGroup
        ]);
    }
}
