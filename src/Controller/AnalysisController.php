<?php

namespace App\Controller;

use App\Entity\Artykuly;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
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
        $title = 'Analiza zamówień';

        $orders = $this->connection->fetchAll(
            'SELECT *
                FROM zamowienia
                LEFT JOIN kontrahenci k on zamowienia.id_kontrahenta = k.id_kontrahenta
                ORDER BY wartosc_netto DESC
                LIMIT 5');

//        dump($orders[0]['wartosc_netto']);
//        dump($orders[1]['wartosc_netto']);
//        dump($orders[2]['wartosc_netto']);
//        dump($orders[3]['wartosc_netto']);
//        dump($orders[4]['wartosc_netto']);die();

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Kontrahent', 'Wartość zamowienia netto'],
                [$orders[0]['nazwa_kontrahenta'],       11.2],
                [$orders[1]['nazwa_kontrahenta'],       2],
                [$orders[2]['nazwa_kontrahenta'],       2],
                [$orders[3]['nazwa_kontrahenta'],       2],
                [$orders[4]['nazwa_kontrahenta'],       7]
            ]
        );
        $pieChart->getOptions()->setTitle('Najwieksze zamowienia');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render(
            'analysis/order.html.twig', [
                'orders' => $orders,
                'title' => $title,
                'piechart' => $pieChart
            ]
        );
    }
}

