<?php

namespace App\Controller;

use App\QueryLogic\Client;
use App\QueryLogic\ClientUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/client-user/{id_client<\d+>}", name="analysis_client_user")
     */
    public function clientUser($id_client, ClientUser $clientUser)
    {
        $clientUser = $clientUser->getData($id_client);

        return new JsonResponse($clientUser);
    }

    /**
     * @Route("/user-order/{id_client}/{id_user}", name="analysis_user_order")
     */
    public function userOrder($id_client, $id_user, ClientUser $clientUser, Client $client, Request $request)
    {
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));
        $userDetail = $clientUser->getClientUserOrderDetail($id_client, $id_user, $from, $to);
        $userOrder = $clientUser->getUserClientOrder($id_client, $id_user, $from, $to);

        // sprawdzenie, czy jest kontrahent o tym id

        $ifClientExist = $client->getData(null, $id_client);

        // sprawdzenie czy jest user o takim id u kontrahenta
        $ifUserExist = $clientUser->getData($id_client, $id_user);

        $data = [
            'title' => 'Zamówienia użytkownika',
            'client_exist' => $ifClientExist,
            'user_exist' => $ifUserExist,
            'user_client_order' => $userOrder,
            'user_client_order_detail' => $userDetail,
            'from' => $from,
            'to' => $to,
        ];
        dump($data);
        return $this->render("user/client-order.html.twig", $data);
    }
}
