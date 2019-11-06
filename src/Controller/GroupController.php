<?php

namespace App\Controller;

use App\QueryLogic\ClientGroup;
use App\QueryLogic\Group;
use App\QueryLogic\GroupOrder;
use App\QueryLogic\OrderGroup;
use App\Service\ChartRender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    /**
     * @Route("/group", name="analysis_group")
     */
    public function group(Group $group)
    {
        $data = $group->getData();

        return new JsonResponse($data);
    }

    /**
     * @Route("/group-order-all", name="analysis_group_order_all")
     * @param Request $request
     * @param ChartRender $chartRender
     * @param GroupOrder $groupOrder
     * @param OrderGroup $orderGroup
     * @return Response
     */
    public function groupOrderAll(Request $request, ChartRender $chartRender, GroupOrder $groupOrder, OrderGroup $orderGroup
    )
    {
        $titleOrderGroup = "Wartość zamówień kontrahentów w grupach w wybranym okresie";
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));
        $chart = [];

        $clientGroup = $groupOrder->getAll(null, $from, $to);

        // Suma wartości zamówień netto

        $sumNet = 0;
        foreach ($clientGroup as $item) {
            $sumNet += $item["wartosc_zamowien_netto"];
        }

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
        $data = [
            'client_group' => $clientGroup,
            'bar_chart' => $chart,
            'title' => $titleOrderGroup,
            'from' => $from,
            'to' => $to,
            'sum_net' => $sumNet,
            'order_group' => $orderGroup
        ];
        return $this->render('group/group-order-all.html.twig', $data);
    }

    /**
     * @Route("/group-order/{id_group}",  name="analysis_group_order")
     */

    public function GroupOrder(
        $id_group = null,
        Request $request,
        ChartRender $chartRender,
        ClientGroup $clientGroup,
        GroupOrder $groupOrder,
        OrderGroup $orderGroup,
        Group $groups
    )
    {
        $titleOrderGroup = "Wartość zamówień kontrahentów w grupie";
        $group = htmlspecialchars($request->query->get("group"));
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));
        $chart = [];
        $pieChart = [];
        $columnChart = [];



        $orderGroup = $groupOrder->getGroup($id_group, $from, $to);


        // Zapełnianie danych do ColumnChart
        if ($id_group) {
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
            'title' => $titleOrderGroup,
            'from' => $from,
            'to' => $to,
//            'group' => $group,
            'id_group' => $id_group,
//            'groups' => $allGroups,
            'order_group' => $orderGroup
        ];
        dump($data);

        return $this->render('group/group-order.html.twig', $data);
    }
}
