<?php

namespace App\Controller;

use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class QuestionsListController extends AbstractController {

    /**
     * @Route("/show", name="showList")
     */
    public function showList() {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->findAll();

        return $this->render('Blocks/questions.html.twig', ['questions' => $questions]);
    }
}

?>