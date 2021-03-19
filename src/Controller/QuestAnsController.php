<?php
namespace App\Controller;

use App\Entity\Question;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestAnsController extends AbstractController {

    /**
     * @Route("/questions/{id}", name="showQA")
     */
    public function showQA(int $id) {
        $repository = $this->getDoctrine()->getRepository(Question::class);
        $question = $repository->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $question->setViews($question->getViews() + 1);

        $entityManager->persist($question);
        $entityManager->flush();

        return $this->render('Layouts/questions/fullqa.html.twig', ["qst"=>$question]);
    }
}

?>