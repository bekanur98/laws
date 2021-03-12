<?php
namespace App\Controller;

use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsNotAnsweredController extends AbstractController {
    /**
     * @Route("/unanswered_questions", name="notAnsweredQuestions")
     */
    public function showNotAnsweredQuestions() {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->findAll();

        return $this->render('Blocks/questions_not_answered.html.twig', ['questions'=>$questions]);
    }
}
?>