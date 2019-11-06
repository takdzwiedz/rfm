<?php

namespace App\Controller;

use App\QueryLogic\ClientGroup;
use App\QueryLogic\Group;
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
     * @Route("/group-order", name="analysis_group_order_all")
     * @param Request $request
     * @param ChartRender $chartRender
     * @param ClientGroup $clientGroup
     * @param OrderGroup $orderGroup
     * @param Group $groups
     * @return Response
     */
    public function groupOrder(Request $request, ChartRender $chartRender, ClientGroup $clientGroup, OrderGroup $orderGroup
    )
    {
        $titleOrderGroup = "Wartość zamówień kontrahentów w grupie w wybranym okresie";
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));
        $chart = [];

        $clientGroup = $clientGroup->getData($from, $to);

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
        dump($data);

        return $this->render('group/group-order.html.twig', $data);
    }


}
