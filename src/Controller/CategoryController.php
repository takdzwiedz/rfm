<?php

namespace App\Controller;

use App\QueryLogic\Category;
use App\QueryLogic\Subcategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="analysis_category")
     * @param Category $category
     * @return JsonResponse
     */
    public function productCategory(Category $category)
    {
        return new JsonResponse($category->getData());
    }

    /**
     * @Route("/category/{id_parent}/{id_category}", name="analysis_category_product")
     * @param $id_parent
     * @param $id_category
     * @param Category $category
     * @return Response
     */
    public function productCategoryList(Request $request, $id_parent, $id_category = 0, Category $category)
    {
        $from = htmlspecialchars($request->query->get("from"));
        $to = htmlspecialchars($request->query->get("to"));

        $productCategory = $category->getCategoryData($id_parent, $id_category, $from, $to);
        $categoryDetail = $category->getCategoryDetail($id_parent);

        $data = [
            'title' => 'Sprzedaż artykułów w kategorii głównej',
            'category_product' =>$productCategory,
            'category_detail' => $categoryDetail,
            'from' => $from,
            'to' => $to,
        ];
        dump($data);
        return $this->render("category/category.html.twig", $data);
    }

    /**
     * @Route("/subcategory/{id_parent}/{id_category}", name="analysis_subcategory")
     */
    public function subcategory($id_parent, $id_category, Subcategory $subcategory)
    {
        return new JsonResponse($subcategory->getData($id_parent, $id_category));
    }
}
