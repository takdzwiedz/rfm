<?php


namespace App\Controller;


use App\Entity\Artykuly;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnalysisController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Tu powstanie moduł analiz');
    }

    /**
     * @Route("/article/{id}", name="article_show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Artykuly::class)
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                "Nie ma artykułu o id: " . $id
            );
        }

//        return new Response('Oto artykuł: '.$article->getNazwaArtykulu());
        return $this->render('analysis/article.html.twig', [
            'article_name' => $article->getNazwaArtykulu()
        ]);
    }
}