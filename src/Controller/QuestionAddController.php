<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class QuestionAddController extends AbstractController {

    /**
     * @var Security
     */
    public function __construct(Security $security) {
        $this->security = $security;
    }

    /**
     * @Route("/questions/add", name="add_question")
     * @param Request $request
     * @return Response
     */

    public function createQuestion(EntityManagerInterface $entityManager, Request $request) {

        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);

        $question->setUser($this->security->getUser());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Question ques
             */
            $ques = $form->getData();

            $entityManager->persist($ques);
            $entityManager->flush();

            $this->addFlash('success', 'Question successfully created!');

            return $this->redirectToRoute('newQuestions');
        }

        return $this->render('Layouts/questions/question_ask.html.twig', array(
            'form' => $form->createView()
        ));
    }
}

?>