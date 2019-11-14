<?php

namespace App\Controller;

use App\QueryLogic\Subcategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SubcategoryController extends AbstractController
{
    /**
     * @Route("/subcategory-list/{id_subcategory}", name="analysis_subcategory_product")
     */
    public function subcategoryList($id_subcategory, Subcategory $subcategory)
    {
        $subcategoryProducts = $subcategory->getSubcategoryData($id_subcategory);

        $data = [
            'controller_name' => 'SubcategoryController',
            'subcategory_product' => $subcategoryProducts
        ];
        dump($data);
        return $this->render('subcategory/subcategory.html.twig', $data);
    }
}
