<?php

namespace App\Controller;

use App\QueryLogic\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/user-order-list/{id_order<\d+>}", name="analysis_order_list_json")
     */
    public function userOrder($id_order, Order $order)
    {
        $order = $order->getData($id_order);

        return new JsonResponse($order);
    }

    /**
     * @Route("/order-list/{id_order<\d+>}", name="analysis_order_list")
     */
    public function order($id_order, Order $order, Session $session)
    {
        if ($session->get('logged') == true) {

            $orderList = $order->getData($id_order);
            $orderDetails = $order->getOrderDetail($id_order);
            $data = [

                'order_number' => $id_order,
                'order' => $orderList,
                'order_details' => $orderDetails,
                'title' => 'Zamówienie',
                'user' => $session->get('user'),
            ];

            dump($data);
            return $this->render('order/order.html.twig', $data);

        } else {
            return $this->render('security/index.html.twig');
        }
    }
}
