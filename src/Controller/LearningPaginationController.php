<?php


namespace App\Controller;


use App\Entity\Kontrahenci;
use App\Entity\KontrahenciGrupy;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LearningPaginationController extends AbstractController
{
    /**
     * @Route("/pagination", name="analysis_learning_pagination")
     */
    public function index(
        Request $request,
        EntityManagerInterface $em,
        PaginatorInterface $paginator
    )
    {
        


        $qb = $em->createQueryBuilder(Kontrahenci::class);

        $qb->select('k', 'kg' )
            ->from('App\Entity\Kontrahenci',  'k')
            ->innerJoin(KontrahenciGrupy::class, 'kg', Expr\Join::WITH, 'k.idGrupy = kg.idGrupy ')
            ->where('k.id > 6210 and  k.id < 6413')
            ->orderBy('k.nazwaKontrahenta', 'ASC');


        $dql = "SELECT k 
                FROM App\Entity\Kontrahenci k";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $qb, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        // parameters to template
        return $this->render("learning/learning-pagination.html.twig", [
            'test' => 'test',
            'pagination' => $pagination
        ]);
    }
}
