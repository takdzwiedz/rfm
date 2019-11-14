<?php

namespace App\Controller;

use App\QueryLogic\ProductSale;
use App\QueryLogic\ProductSubcategory;
use App\QueryLogic\Subcategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function subcategoryProduct($id_subcategory, Subcategory $subcategory)
    {
        $subcategoryProducts = $subcategory->getSubcategoryData($id_subcategory);

        $data = [
            'controller_name' => 'SubcategoryController',
            'subcategory_product' => $subcategoryProducts
        ];
        dump($data);
        return $this->render('subcategory/subcategory.html.twig', $data);
    }

    /**
     * @Route("/product-sale/{id_product}", name="analysis_product_sale")
     */
    public function productSale($id_product, ProductSale $productSale)
    {
        $productSaleDetail = $productSale->getData($id_product);

        $data = [
            'product_sale_detail' => $productSaleDetail
        ];
        dump($data);
        return $this->render("product/product-sale.html.twig", $data);
    }
}
