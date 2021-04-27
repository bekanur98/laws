<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\QuestionLike;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class QuestRatingController extends AbstractController {
    /**
     * @var Security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route ("/questions/rating/{id}/{like}", name="ratingUpdate")
     * @param Request $request
     * @param $id
     * @param $like
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ratingUpdate(Request $request, $id, $like) {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository(Question::class)->find($id);
        $user = $this->security->getUser();
        if(!$this->security->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        else {
            $ql = $em->getRepository(QuestionLike::class)->findByQuestionUser($id, $user->getId());
            if ($like == 1) {
                if ($ql) {
                    if ($ql[0]->getIsLiked()) {
                        if ($ql[0]->getIsUpvote()) {
                            $question->setRating($question->getRating() - 1);
                            $ql[0]->setIsLiked(false);
                        } else {
                            $question->setRating($question->getRating() + 1);

                            $ql[0]->setIsUpvote(true);
                        }
                    } else {
                        $question->setRating($question->getRating() + 1);

                        $ql[0]->setIsLiked(true);
                        $ql[0]->setIsUpvote(true);
                    }

                    $em->persist($ql[0]);
                } else {
                    $question->setRating($question->getRating() + 1);

                    $newQl = new QuestionLike();
                    $newQl->addQuestion($question);
                    $newQl->addUser($this->security->getUser());
                    $newQl->setIsLiked(true);
                    $newQl->setIsUpvote(true);

                    $em->persist($newQl);
                }
            } else {
                if ($ql) {
                    if ($ql[0]->getIsLiked()) {
                        if (!$ql[0]->getIsUpvote()) {
                            $question->setRating($question->getRating() + 1);
                            $ql[0]->setIsLiked(false);
                        } else {
                            $question->setRating($question->getRating() - 1);

                            $ql[0]->setIsUpvote(false);
                        }
                    } else {
                        $question->setRating($question->getRating() - 1);

                        $ql[0]->setIsLiked(true);
                        $ql[0]->setIsUpvote(false);
                    }
                } else {
                    $question->setRating($question->getRating() - 1);

                    $newQl = new QuestionLike();
                    $newQl->addQuestion($question);
                    $newQl->addUser($this->security->getUser());
                    $newQl->setIsLiked(true);
                    $newQl->setIsUpvote(false);

                    $em->persist($newQl);
                }
            }

            $users = $em->getRepository(User::class)->findAll();
            foreach($users as $usr) {
                $rating = 0;
                foreach($usr->getQuestions() as $q) {
                    $rating += $q->getRating();
                }
                $usr->setLawRating($rating);
                $em->persist($usr);
            }

            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('showQA', ['id' => $id]);
        }
    }
}

?>