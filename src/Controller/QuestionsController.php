<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Answer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class QuestionsController extends AbstractController {

    /**
     * @var Security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/questions", name="showQuestions")
     */
    public function showQuestions() {

        $user = $this->security->getUser()->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findAllQuestions();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', array('questions'=>$questions, 'userId'=>$user));
    }

    /**
     * @Route("/questions/new", name="newQuestions")
     */
    public function showNewQuestions() {
        $user = $this->security->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findTop5NewQuestions();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions' => $questions, 'user'=>$user]);

    }

    /**
     * @Route("/questions/highest-rated", name="highRated")
     */
    public function showMostAnswered() {
        $user = $this->security->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findTop5HighestRated();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions' => $questions, 'user'=>$user]);

    }

    /**
     * @Route("/questions/answered", name="answeredQuestions")
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

        return $this->render('Layouts/questions/questions_answered.html.twig', ['questions'=>$questions]);
    }

    /**
     * @Route("/questions/unanswered", name="notAnsweredQuestions")
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
     * @Route("/questions/most_visited", name="mostVisitedQuestions")
     */
    public function showMostVisitedQuestions() {
        $user = $this->security->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findTop5Visited();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);
            if(count($q->getAnswers()) != 0)
                $q->setIsAnswered(true);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions'=>$questions, 'user'=>$user]);
    }

    /**
     * @Route("/questions/search/tag", name="searchByTag")
     */
    public function searchByTag(Request $request) {
        $user = $this->security->getUser();
        $em = $this->getDoctrine()->getManager();

        $tag = $request->request->get('tag');
        $questions = $em->getRepository(Question::class)->findByTag($tag);

        return $this->render('Layouts/questions/questions.html.twig', array('questions'=>$questions, 'user'=>$user));
    }
}

?>