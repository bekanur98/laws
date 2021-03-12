<?php

namespace App\Controller;

use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class QuestionsController extends AbstractController {

    /**
     * @Route("/show", name="showList")
     */
    public function showList() {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->findAll();

        return $this->render('Layouts/questions/questions.html.twig', array('questions'=>$questions));
    }

    /**
     * @Route("/new_questions", name="newQuestions")
     */
    public function showNewQuestions() {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->findTop5NewQuestions();

        return $this->render('Layouts/questions/questions.html.twig', ['questions' => $questions]);

    }

    /**
     * @Route("/answered_questions", name="answeredQuestions")
     */
    public function showAnsweredQuestions() {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->findAll();

        //ответы почему-то показывает с html тэгами, исправлю позже

        return $this->render('Layouts/questions/questions_answered.html.twig', ['questions'=>$questions]);
    }

    /**
     * @Route("/unanswered_questions", name="notAnsweredQuestions")
     */
    public function showNotAnsweredQuestions() {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->findAll();

        return $this->render('Layouts/questions/questions_not_answered.html.twig', ['questions'=>$questions]);
    }
}

?>