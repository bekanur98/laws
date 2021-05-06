<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AnsweredQuestionController extends AbstractController {

    /**
     * @var Security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/questions/answered", name="answeredQuestions")
     */
    public function showAnsweredQuestions() {
        $u = $this->security->getUser();
        if($u)
            $user = $u->getId();
        else
            $user = null;
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findAnswered();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions'=>$questions, 'userId'=>$user]);
    }

    /**
     * @Route("/questions/unanswered", name="notAnsweredQuestions")
     */
    public function showNotAnsweredQuestions() {
        $u = $this->security->getUser();
        if($u)
            $user = $u->getId();
        else
            $user = null;
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager->getRepository(Question::class)->findUnanswered();

        foreach ($questions as $q) {
            $q->setViews($q->getViews() + 1);

            $entityManager->persist($q);
            $entityManager->flush();
        }

        return $this->render('Layouts/questions/questions.html.twig', ['questions'=>$questions, 'userId'=>$user]);
    }

    /**
     * @Route("questions/set-ans-correct/{id}/{qid}", name="setAsCorrect")
     */
    public function setAsCorrect(Request $request, $id, $qid) {
        $em = $this->getDoctrine()->getManager();
        $answer = $em->getRepository(Answer::class)->find($id);
        $question = $em->getRepository(Question::class)->find($qid);
        $answers = $em->getRepository(Answer::class)->findByQuestion($question);

        if($answer->getIsCorrect()) {
            $answer->setIsCorrect(0);
            $question->setIsAnswered(false);
        }
        else {
            foreach ($answers as $a) {
                if($a == $answer) {
                    $a->setIsCorrect(1);
                    $question->setIsAnswered(true);
                }
                else
                    $a->setIsCorrect(0);

                $em->persist($a);
                $em->flush();
            }
        }

        $em->persist($answer);
        $em->persist($question);
        $em->flush();

        return $this->redirectToRoute('showQA', ['id' => $qid]);
    }
}

?>