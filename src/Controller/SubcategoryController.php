<?php

namespace App\Controller;

use App\QueryLogic\ProductSale;
use App\QueryLogic\ProductSubcategory;
use App\QueryLogic\Subcategory;
use App\Service\ChartRender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SubcategoryController extends AbstractController
{
    /**
     * @Route("/subcategory-product-list/{id_category}", name="analysissubcategory-product-list")
     */
    public function subcategoryProductList($id_category, ProductSubcategory $productSubcategory)
    {
        return new JsonResponse($productSubcategory->getData($id_category));
    }


    /**
     * @Route("/subcategory-product/{id_subcategory}", name="analysis_subcategory_product")
     */
    public function subcategoryProduct(Request $request, $id_subcategory, Subcategory $subcategory)
    {
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));

        $subcategoryProducts = $subcategory->getSubcategoryData($id_subcategory, $from, $to);
        $subcategoryDetail = $subcategory->getSubcategoryDetail($id_subcategory);


        $data = [
            'title' => 'Zamówienia artykułów w podkategoriach',
            'controller_name' => 'SubcategoryController',
            'subcategory_product' => $subcategoryProducts,
            'subcategory_detail' => $subcategoryDetail,
            'from' => $from,
            'to' => $to,
        ];
        dump($data);
        return $this->render('subcategory/subcategory.html.twig', $data);
    }

    /**
     * @Route("/product-sale/{id_product}", name="analysis_product_sale")
     */
    public function productSale(Request $request, $id_product, ProductSale $productSale, ChartRender $chartRender)
    {
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));

        $productSaleDetail = $productSale->getData($id_product, $from, $to);

        $productSaleData = $productSale->getSaleByMonth($id_product);

        $arr = [
            ['Miesiąc', 'Sprzedaż']
        ];

        foreach ($productSaleData as $item) {
            $arr[] = [$item['month'].'/'.$item['year'], floatval($item['sum'])];
        }

        $columnChart = $chartRender->columnChart($arr, 'Sprzedaż produktu');
        $columnChart->getOptions()->setColors('#28A745');

        $data = [
            'title' => 'Dane sprzedażowe artykułu',
            'id_product' => $id_product,
            'product_sale_detail' => $productSaleDetail,
            'product_sale_data' => $productSaleData,
            'from' => $from,
            'to' => $to,
            'column_chart' => $columnChart,
        ];
        dump($data);
        return $this->render("product/product-sale.html.twig", $data);
    }
}
