<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class NewsController extends AbstractController {

    /**
     * @Route("/news", name="showNews")
     */
    public function showNews()
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)->findAll();

        foreach ($news as $n) {
            $n->setViews($n->getViews() + 1);

            $em->persist($n);
            $em->flush();
        }

        return $this->render('Layouts/news/news.html.twig', ['news'=>$news]);
    }

    /**
     * @Route("news/add", name = "createNews")
     */
    public function createNews(Request $request) {

        $entityManager = $this->getDoctrine()->getManager();
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /**
             * @var News news
             */
            $news = $form->getData();

            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('showNews');
        }

        return $this->render('Layouts/news/news_add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
?>