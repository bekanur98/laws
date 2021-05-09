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

        $u = $this->security->getUser();
        if($u)
            $user = $u->getId();
        else
            $user = null;
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
     * @Route("/question/{id}", name="showQA")
     */
    public function showQA(int $id) {
        $u = $this->security->getUser();
        if($u)
            $user = $u->getId();
        else
            $user = null;

        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository(Question::class)->find($id);
        $answers = $em->getRepository(Answer::class)->findSortedAnswers($question);

        $question->setViews($question->getViews() + 1);

        $em->persist($question);
        $em->flush();

        return $this->render('Layouts/questions/fullqa.html.twig', ["qst"=>$question, 'answers'=>$answers, 'userId'=>$user]);
    }

    /**
     * @Route("/questions/new", name="newQuestions")
     */
    public function showNewQuestions() {
        $u = $this->security->getUser();
        if($u)
            $user = $u->getId();
        else
            $user = null;
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findTop5NewQuestions();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions' => $questions, 'userId'=>$user]);

    }

    /**
     * @Route("/questions/highest-rated", name="highRated")
     */
    public function showMostAnswered() {
        $u = $this->security->getUser();
        if($u)
            $user = $u->getId();
        else
            $user = null;
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findTop5HighestRated();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions' => $questions, 'userId'=>$user]);

    }

    /**
     * @Route("/questions/most_visited", name="mostVisitedQuestions")
     */
    public function showMostVisitedQuestions() {
        $u = $this->security->getUser();
        if($u)
            $user = $u->getId();
        else
            $user = null;
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findTop5Visited();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions'=>$questions, 'userId'=>$user]);
    }

    /**
     * @Route("/questions/search/tag", name="searchByTag")
     */
    public function searchByTag(Request $request) {
        $u = $this->security->getUser();
        if($u)
            $user = $u->getId();
        else
            $user = null;
        $em = $this->getDoctrine()->getManager();

        $tag = $request->request->get('tag');
        $questions = $em->getRepository(Question::class)->findByTag($tag);

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $em->persist($q);
            $em->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', array('questions'=>$questions, 'userId'=>$user));
    }
}

?>