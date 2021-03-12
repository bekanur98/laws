<?php
namespace App\Controller;

use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsNewController extends AbstractController {
    /**
     * @Route("/new_questions", name="newQuestions")
     */
    public function showNewQuestions() {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository->findTop5NewQuestions();

        return $this->render('Blocks/questions.html.twig', ['questions' => $questions]);

    }
}
?>