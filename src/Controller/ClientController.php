<?php

namespace App\Controller;

use App\QueryLogic\Group;
use App\QueryLogic\GroupClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
}
