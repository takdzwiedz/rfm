<?php

namespace App\Controller;

use App\QueryLogic\ProductGroup;
use App\Service\ChartRender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="analysis_product")
     */
    public function productGroup(Request $request, ProductGroup $productGroup, ChartRender $chartRender)
    {
        $title = "Sprzedaż artykułów w kategoriach";

        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));

        $orderGroup = $productGroup->getData($from, $to);

        $categories = [];

        if ($orderGroup) {
            foreach ($orderGroup as $row) {
                if (!array_search($row["nazwa_kategorii"], $categories)) {
                    $categories[] = $row["nazwa_kategorii"];
                }
            }
        }

        $barChartData = [
            ['Nazwa kategorii', 'Ilość sprzedanych produktów', 'Suma netto sprzedanych produktów']
        ];
        foreach ($orderGroup as $row) {
            $barChartData[] = [
                $row["nazwa_kategorii"],
                floatval($row["ilosc_sprzedanych_produktow"]),
                floatval($row["suma_netto_sprzedanych_produktow"])
            ];
        }

        $barChart = $chartRender->barChart($barChartData,
            'Sprzedaż w kategoriach głównych',
            'Ilość sprzedanych produktów',
            'Suma sprzedaży netto produktów',
            'Ilość sprzedanych produktów');
        $barChart->getOptions()->setColors(['orange', 'green']);

        $data = [
            'title' => $title,
            'data' => $orderGroup,
            'categories' => $categories,
            'from' => $from,
            'to' => $to,
            'bar_chart' => $barChart,
        ];
        dump($data);
        return $this->render('product/product-category.twig', $data);
    }
}
