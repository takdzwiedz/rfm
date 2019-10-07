<?php

namespace App\Controller;

use App\Entity\Artykuly;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnalysisController extends AbstractController
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(
        Connection $connection)
    {

        $this->connection = $connection;
    }

    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Tu powstanie moduł analiz');
    }

    /**
     * @Route("/article/{id}", name="article_show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Artykuly::class)
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                "Nie ma artykułu o id: " . $id
            );
        }

        return $this->render('analysis/article.html.twig', [
            'article_name' => $article->getNazwaArtykulu()
        ]);
    }

    /**
     * @Route("/order", name="article_all")
     * @return Response
     */
    public function order()
    {
        $orders = $this->connection->fetchAll(
            'SELECT *
                FROM zamowienia
                LEFT JOIN kontrahenci k on zamowienia.id_kontrahenta = k.id_kontrahenta
                ORDER BY wartosc_netto DESC
                LIMIT 25');

        return $this->render(
            'analysis/order.html.twig', [
                'orders' => $orders
            ]
        );
    }
}

