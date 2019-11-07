<?php

namespace App\Controller;

use App\QueryLogic\ClientOrder;
use App\QueryLogic\GroupClient;
use App\QueryLogic\GroupOrder;
use App\Service\ChartRender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/group-client/{id_group}", name="analysis_group_client")
     *
     */
    public function groupClient($id_group, GroupClient $groupClient, Request $request)
    {

        $data = $groupClient->getData($id_group);

        return new JsonResponse($data);
    }

    /**
     * @Route("/client-order/{id_client}", name="analysis_client_order")
     * @param $id_client
     * @param ClientOrder $clientOrder
     * @param GroupOrder $groupOrder
     * @return Response
     */
    public function clientOrder($id_client, ClientOrder $clientOrder, GroupOrder $groupOrder, Request $request, ChartRender $chartRender)
    {

        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));
        if ($clientOrder->getData($id_client)) {

            $client = $clientOrder->getData($id_client)[0];

            $clientName = $client['client_name'];
            $idGroup = $client['id_group'];
            $groupName = $client['group_name'];
        } else {
            $clientName = '';
            $idGroup = '';
            $groupName = '';
        }

        $groupOrder = $groupOrder->getGroup($idGroup, null, null, $id_client);

        $clientOrder = $clientOrder->getData($id_client);



        $arr = [
            ['Nazwa użytkownika', 'Wartość zamowienń netto']
        ];
        if ($clientOrder) {
            foreach ($clientOrder as $order) {
                $arr[] = [
                    $order['username_name'], floatval($order['net_sum'])
                ];
            }
        }

        $pieChart = $chartRender->pieChart($arr, 'Udział użytkowników w zamówieniach netto');

        $data = [
            'title' => 'Zamówienia kontrahenta',
            'client_name' => $clientName,
            'id_group' => $idGroup,
            'group_name' => $groupName,
            'client_order' => $clientOrder,
            'group_order' => $groupOrder,
            'from' => $from,
            'to' => $to,
            'pie_chart' => $pieChart,
        ];
        dump($data);
        return $this->render("client/client-order.html.twig", $data);
    }
}
