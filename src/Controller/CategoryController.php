<?php

namespace App\Controller;

use App\QueryLogic\Category;
use App\QueryLogic\Subcategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function productCategoryList($id_parent, $id_category, Category $category)
    {
        $productCategory = $category->getCategoryData($id_parent, $id_category);

        $data = [
            'category_product' =>$productCategory
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
