<?php

namespace App\Controller;

use App\QueryLogic\Product;
use App\QueryLogic\Search;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="analysis_search")
     */
    public function index(Request $request, Search $search)
    {

        $value = $request->get('search');

        $result = $search->search($value);

        dump($value, $result);

        if ($result) {
            return $this->redirect('product-sale/'. $result[0]['id_artykulu']);
        }

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
    /**
     * @Route("/search-product/{value}", name="analysis_search_product")
     */
    public function searchProduct($value, Product $product)
    {
        $product = $product->search($value);

        return new JsonResponse($product);
    }



}
