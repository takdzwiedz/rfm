<?php


namespace App\Controller;


use App\Entity\Zamowienia;
use App\Repository\KontrahenciRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LearningPaginationController extends AbstractController
{
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var FormBuilderInterface
     */
    private $formBuilder;


    public function __construct(

        Connection $connection
    )
    {
        $this->connection = $connection;
    }

    /**
     * @Route("/pagination", name="analysis_learning_pagination")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param PaginatorInterface $paginphp bin/console debug:autowiringator
     * @return Response
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
            ->innerJoin('App\Entity\KontrahenciGrupy', 'kg', 'ON', 'k.idGrupy = kg.idGrupy ')
            ->where('k.id > 6210 and  k.id < 6413')
            ->orderBy('k.nazwaKontrahenta', 'ASC');


        $dql = "SELECT k 
                FROM App\Entity\Kontrahenci k";


        $query = $em->createQuery($dql);

        $clientGroup = $this->connection->fetchAll(
            '
            SELECT
                k.id id,
                kg.nazwa_grupy nazwa_grupy,
                k.nazwa_skrocona nazwa_skrocona,
                k.nip nip,
                k.nazwa_kontrahenta nazwa_kontrahenta
            FROM computer_test.kontrahenci k
            LEFT JOIN computer_test.kontrahenci_grupy kg on k.id_grupy = kg.id_grupy
            WHERE czy_aktywny = 1         
            '
        );


        $pagination = $paginator->paginate(
            $clientGroup, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        // parameters to template
        return $this->render("learning/learning-pagination.html.twig", [
            'pagination' => $pagination
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param PaginatorInterface $paginator
     * @return Response
     * @Route("/order2")
     */
    public function order2(        Request $request,
                                   EntityManagerInterface $em,
                                   PaginatorInterface $paginator)
    {
        $pagination = $paginator->paginate(
            $query = $em->createQueryBuilder()
            ->select('o')
            ->from(Zamowienia::class, 'o'), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        // parameters to template
        return $this->render("learning/orders2.html.twig", [
            'pagination' => $pagination
        ]);
    }
}
