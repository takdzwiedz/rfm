<?php


namespace App\Controller;


use App\QueryLogic\Group;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NavigationController extends AbstractController

{
    /**
     * @Route("/groups", name="analysis_contractor_group")
     */
    public function getGroups(Group $group) {

        $groups = $group->getData();


        return $this->render('base.html.twig', [
            'nav' => $groups
        ]);
    }
    /**
     * @Route("/groups2", name="analysis_contractor_group2")
     */
    public function getGroups2(Group $group) {

        $groups = $group->getData();

        return new JsonResponse($groups);
    }
}