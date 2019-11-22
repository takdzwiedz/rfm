<?php

namespace App\Controller;

use App\QueryLogic\ProductGroup;
use App\QueryLogic\ProductSale;
use App\Service\ChartRender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="analysis_product")
     * @param Request $request
     * @param ProductGroup $productGroup
     * @param ChartRender $chartRender
     * @param ProductSale $productSale
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function productGroup(Request $request, ProductGroup $productGroup, ChartRender $chartRender, ProductSale $productSale, Session $session)
    {
        if ($session->get('logged') == true) {

            $title = "Sprzedaż artykułów w kategoriach";
            $from = htmlspecialchars($request->query->get("from"));
            $to = htmlspecialchars($request->query->get("to"));
            $orderGroup = $productGroup->getData($from, $to);

            $barChartData = [
                ['Nazwa kategorii', 'Ilość sprzedanych produktów', 'Suma netto sprzedanych produktów']
            ];
            foreach ($orderGroup as $row) {
                $barChartData[] = [
                    $row["category_name"],
                    floatval($row["quantity"]),
                    floatval($row["sum_net"])
                ];
            }

            $barChart = $chartRender->barChart($barChartData,
                'Sprzedaż w kategoriach głównych',
                'Ilość sprzedanych produktów',
                'Suma sprzedaży netto produktów',
                'Ilość sprzedanych produktów');
            $barChart->getOptions()->setColors(['orange', 'green']);

            $productSale = $productSale->getSaleByMonth();

//        $columnChart = $chartRender->columnChart();

            $data = [
                'bar_chart' => $barChart,
                'data' => $orderGroup,
                'from' => $from,
                'title' => $title,
                'to' => $to,
                'user' => $session->get('user'),
            ];
            dump($data);
            return $this->render('product/product-category.html.twig', $data);

        } else {
            return $this->render('security/index.html.twig');
        }
    }
}
