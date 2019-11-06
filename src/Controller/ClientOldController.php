<?php

namespace App\Controller;

use App\QueryLogic\Client;
use App\QueryLogic\ClientGroup;
use App\QueryLogic\Group;
use App\QueryLogic\OrderGroup;
use App\Service\ChartRender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientOldController extends AbstractController
{

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

        $data = [
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
        ];
        dump($data);

        return $this->render('analysis/client-group.html.twig', $data);
    }

}
