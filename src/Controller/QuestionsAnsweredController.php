<?php
namespace App\Controller;

use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsAnsweredController extends AbstractController {
    /**
     * @Route("/answered_questions", name="answeredQuestions")
     */
    public function showAnsweredQuestions() {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->findAll();

        return $this->render('Blocks/questions_answered.html.twig', ['questions'=>$questions]);
    }
}
?>