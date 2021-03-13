<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Answer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class QuestionsController extends AbstractController {

    /**
     * @Route("/show", name="showList")
     */
    public function showList() {
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findAll();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', array('questions'=>$questions));
    }

    /**
     * @Route("/new_questions", name="newQuestions")
     */
    public function showNewQuestions() {
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findTop5NewQuestions();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions' => $questions]);

    }

    /**
     * @Route("/answered_questions", name="answeredQuestions")
     */
    public function showAnsweredQuestions() {
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findAll();

        foreach ($questions as $q) {
            if(count($q->getAnswers()) > 0) {
                $q->setViews($q->getViews() + 1);
                $q->setIsAnswered(true);
            }

            $entityManager->persist($q);
            $entityManager->flush();
        }

        //ответы почему-то показывает с html тэгами, исправлю позже

        return $this->render('Layouts/questions/questions_answered.html.twig', ['questions'=>$questions]);
    }

    /**
     * @Route("/unanswered_questions", name="notAnsweredQuestions")
     */
    public function showNotAnsweredQuestions() {
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findAll();

        foreach ($questions as $q) {
            if(count($q->getAnswers()) > 0) {
                $q->setViews($q->getViews() + 1);
                $q->setIsAnswered(true);
            }

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions_not_answered.html.twig', ['questions'=>$questions]);
    }

    /**
     * @Route("/most_visited/questions", name="mostVisitedQuestions")
     */
    public function showMostVisitedQuestions() {
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findTop5Visited();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);
            if(count($q->getAnswers()) != 0)
                $q->setIsAnswered(true);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions'=>$questions]);
    }
}

?>