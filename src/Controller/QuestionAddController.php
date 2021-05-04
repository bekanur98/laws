<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\AnswerType;
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

        if(!$this->security->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        else {
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

                $this->addFlash(
                    'success',
                    'Question successfully created!'
                );

                return $this->redirectToRoute('newQuestions');
            }

            return $this->render('Layouts/questions/question_ask.html.twig', array(
                'form' => $form->createView()
            ));
        }
    }

    /**
     * @Route("/questions/answer/{id}", name="answer_question")
     * @param Request $request
     * @return Response
     */

    public function answerToQuestion(EntityManagerInterface $entityManager, Request $request, $id) {
        if(!$this->security->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        else {
            $answer = new Answer();
            $form = $this->createForm(AnswerType::class, $answer);

            $answer->setUser($this->security->getUser());
            $question = $entityManager->getRepository(Question::class)->find($id);
            $answer->setQuestion($question);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /**
                 * @var Answer ans
                 */
                $ans = $form->getData();

                $entityManager->persist($ans);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    'Answer successfully added!'
                );

                return $this->redirectToRoute('showQA', ['id' => $id]);
            }

            return $this->render('Layouts/questions/ans_to_question.html.twig', array(
                'form' => $form->createView()
            ));
        }
    }
}

?>