<?php

namespace App\Controller;

use App\QueryLogic\Product;
use App\QueryLogic\ProductSale;
use App\QueryLogic\ProductSubcategory;
use App\QueryLogic\Subcategory;
use App\Service\ChartRender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
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
    public function subcategoryProduct(Request $request, $id_subcategory, Subcategory $subcategory, Session $session)
    {
        if ($session->get('logged') == true) {

            $from = htmlspecialchars($request->query->get("from"));
            $to = htmlspecialchars($request->query->get("to"));
            $subcategoryProducts = $subcategory->getSubcategoryData($id_subcategory, $from, $to);
            $subcategoryDetail = $subcategory->getSubcategoryDetail($id_subcategory);
            $data = [
                'controller_name' => 'SubcategoryController',
                'from' => $from,
                'subcategory_product' => $subcategoryProducts,
                'subcategory_detail' => $subcategoryDetail,
                'title' => 'Zamówienia artykułów w podkategoriach',
                'to' => $to,
                'user' => $session->get('user'),
            ];
            dump($data);
            return $this->render('subcategory/subcategory.html.twig', $data);
        } else {
            return $this->render('security/index.html.twig');
        }
    }

    /**
     * @Route("/product-sale/{id_product}", name="analysis_product_sale")
     */
    public function productSale(Request $request, $id_product, ProductSale $productSale, Product $product, ChartRender $chartRender, Session $session)
    {
        if ($session->get('logged') == true) {

            $from = htmlspecialchars($request->query->get("from"));
            $to = htmlspecialchars($request->query->get("to"));
            $unit = $request->query->get("unit") ? htmlspecialchars($request->query->get("unit")) : 'month';
            $productSaleDetail = $productSale->getData($id_product);
            $date = new \DateTime();
            $toDefault = $date->format("Y-m-d");
            $fromDefault = $date->modify("-12 months")->format("Y-m-d");
            $units = [
                [
                    'unit' => 'year',
                    'unit_name' => 'roczne'
                ],
                [
                    'unit' => 'quarter',
                    'unit_name' => 'kwartalnie'
                ],
                [
                    'unit' => 'month',
                    'unit_name' => 'miesięczne'
                ],
                [
                    'unit' => 'week',
                    'unit_name' => 'tygodniowo'
                ],
                [
                    'unit' => 'day',
                    'unit_name' => 'dzienne'
                ],
            ];
            $unitDefault = "month";
            $productDetail = $product->search($id_product);
            $productOrderList = $product->productOrderDetail(
                $id_product,
                $from ? $from : $fromDefault,
                $to ? $to : $toDefault
            );
            $productSaleData = $productSale->getSaleByMonth(
                $id_product,
                $from ? $from : $fromDefault,
                $to ? $to : $toDefault,
                $unit ? $unit : 'month'
            );

            if ($unit == 'day') {
                $period = "Dzień";
            } elseif ($unit == 'week') {
                $period = 'Tydzień';
            } elseif ($unit == 'month' or $unit == null) {
                $period = 'Miesiąc';
            } elseif ($unit == 'quarter') {
                $period = 'Kwartał';
            } else {
                $period = "Rok";
            }

            $arr = [
                [$period, 'Sprzedaż']
            ];

            foreach ($productSaleData as $item) {

                if ($unit == 'day') {
                    $arr[] = [$item['day'] . '/' . $item['month'] . '/' . $item['year'], floatval($item['sum'])];
                } elseif ($unit == 'week') {
                    $arr[] = [$item['week'] . '/' . $item['year'], floatval($item['sum'])];
                } elseif ($unit == 'month' or $unit == null) {
                    $arr[] = [$item['month'] . '/' . $item['year'], floatval($item['sum'])];
                } elseif ($unit == 'quarter') {
                    $arr[] = [$item['quarter'] . '/' . $item['year'], floatval($item['sum'])];
                } else {
                    $arr[] = [$item['year'], floatval($item['sum'])];
                }
            }

            $controlSum = 0;
            foreach ($productSaleData as $item) {
                $controlSum += floatval($item['sum']);
            }

            $columnChart = $chartRender->columnChart($arr, 'Sprzedaż produktu');
            $columnChart->getOptions()->setColors('#28A745');

            $data = [
                'control_sum' => $controlSum,
                'column_chart' => $columnChart,
                'from' => $from,
                'id_product' => $id_product,
                'product' => $productDetail,
                'product_order_list' => $productOrderList,
                'product_sale_detail' => $productSaleDetail,
                'product_sale_data' => $productSaleData,
                'title' => 'Dane sprzedażowe artykułu',
                'to' => $to,
                'unit' => $unit,
                'units' => $units,
                'unit_default' => $unitDefault,
                'user' => $session->get('user'),
            ];
            dump($data);
            return $this->render("product/product-sale.html.twig", $data);

        } else {
            return $this->render('security/index.html.twig');
        }
    }
}
