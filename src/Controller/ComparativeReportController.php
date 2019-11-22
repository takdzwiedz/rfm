<?php

namespace App\Controller;

use App\QueryLogic\ProductSale;
use App\Service\ChartRender;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ComparativeReportController extends AbstractController
{
    /**
     * @Route("/comparative-report", name="analysis_comparative_report")
     * @param ProductSale $productSale
     * @param ChartRender $chartRender
     * @return Response
     */
    public function index(ProductSale $productSale, ChartRender $chartRender, Session $session)
    {
        if ($session->get('logged') == true) {

            $productSale = $productSale->getDataByMonth();

//        $columnChart = $chartRender->columnChart();

            $col = new ColumnChart();
            $col->getData()->setArrayToDataTable(
                [
                    ['Rok / miesiąc', 'Sprzedaż', ['role' => 'annotation']],
                    [['v' => [2018, 1], 'f' => '1'], 2, '2'],
                    [['v' => [2018, 2], 'f' => '2'], 2, '2'],
                    [['v' => [2018, 3], 'f' => '3'], 3, '3'],
                    [['v' => [2018, 4], 'f' => '4'], 4, '4'],
                    [['v' => [2018, 5], 'f' => '5'], 5, '5'],
                ]
            );
            $col->getOptions()
                ->setTitle('Sprzedaż')
                ->setWidth(500)
                ->setHeight(400);
            $col->getOptions()
                ->getAnnotations()
                ->setAlwaysOutside(true)
                ->getTextStyle()
                ->setAuraColor('none')
                ->setFontSize(14)
                ->setColor('#000');
            $col->getOptions()
                ->getHAxis()
                ->setFormat('Y:m')
                ->setTitle('Miesiąc')
                ->getViewWindow()
                ->setMin([2018, 1])
                ->setMax([2018, 10]);
            $col->getOptions()
                ->getVAxis()
                ->setTitle('Sprzedaż');

            $arr = [
                ['Miesiąc', 'Sprzedaż']
            ];

            foreach ($productSale as $item) {
                $arr[] = [$item['month'] . '/' . $item['year'], floatval($item['sum'])];
            }

            $chart = new ColumnChart();
            $chart->getData()->setArrayToDataTable($arr);

            $chart->getOptions()->getChart()
                ->setTitle('Sprzedaż')
                ->setSubtitle('Sprzedaż za okres');
            $chart->getOptions()
                ->setBars('vertical')
                ->setHeight(400)
                ->setWidth(500)
                ->setColors(['#1b9e77', '#d95f02', '#7570b3'])
                ->getVAxis()
                ->setFormat('decimal');

            $data = [
                'arr' => $arr,
                'controller_name' => 'ComparativeReportController',
                'column_chart' => $col,
                'column_chart_2' => $chart,
                'product_sale' => $productSale,
                'user' => $session->get('user'),
            ];

            dump($data);

            return $this->render('comparative_report/index.html.twig', $data);

        } else {
            return $this->render('security/index.html.twig');
        }
    }
}
