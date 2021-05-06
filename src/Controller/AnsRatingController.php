<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\AnswerLike;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class AnsRatingController extends AbstractController {
    /**
     * @var Security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("answers/rating/{id}/{qid}/{like}", name="ansRatingUpdate")
     * @param Request $request
     * @param $id
     * @param $qid
     * @param $like
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ratingUpdate(Request $request, $id, $qid, $like) {

        $em = $this->getDoctrine()->getManager();
        $answer = $em->getRepository(Answer::class)->find($id);
        $user = $this->security->getUser();
        if(!$this->security->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        else {
            if($answer->getUser() == $user) {
                $this->addFlash(
                    'error',
                    'You can\'t rate your own answer!'
                );

                return $this->redirectToRoute('showQA', ['id' => $qid]);
            }
            $al = $em->getRepository(AnswerLike::class)->findByAnswerUser($id, $user->getId());
            if ($like == 1) {
                if ($al) {
                    if ($al[0]->getIsLiked()) {
                        if ($al[0]->getIsUpvote()) {
                            $answer->setRating($answer->getRating() - 1);
                            $al[0]->setIsLiked(false);
                            $em->remove($al[0]);
                            $em->flush();
                        }
                        else if($al[0]->getIsUpvote() == false) {
                            $answer->setRating($answer->getRating() + 2);
                            $al[0]->setIsUpvote(true);
                        }
                        else {
                            $answer->setRating($answer->getRating() + 1);

                            $al[0]->setIsUpvote(true);
                        }
                    } else {
                        $answer->setRating($answer->getRating() + 1);

                        $al[0]->setIsLiked(true);
                        $al[0]->setIsUpvote(true);
                    }

                    $em->persist($al[0]);
                } else {
                    $answer->setRating($answer->getRating() + 1);

                    $newAl = new AnswerLike();
                    $newAl->addAnswer($answer);
                    $newAl->addUser($this->security->getUser());
                    $newAl->setIsLiked(true);
                    $newAl->setIsUpvote(true);

                    $em->persist($newAl);
                }
            } else {
                if ($al) {
                    if ($al[0]->getIsLiked()) {
                        if (!$al[0]->getIsUpvote()) {
                            $answer->setRating($answer->getRating() + 1);
                            $al[0]->setIsLiked(false);
                            $em->remove($al[0]);
                            $em->flush();
                        }
                        else if($al[0]->getIsUpvote()) {
                            $answer->setRating($answer->getRating() - 2);
                            $al[0]->setIsUpvote(false);
                        }
                        else {
                            $answer->setRating($answer->getRating() - 1);

                            $al[0]->setIsUpvote(false);
                        }
                    } else {
                        $answer->setRating($answer->getRating() - 1);

                        $al[0]->setIsLiked(true);
                        $al[0]->setIsUpvote(false);
                    }
                } else {
                    $answer->setRating($answer->getRating() - 1);

                    $newAl = new AnswerLike();
                    $newAl->addAnswer($answer);
                    $newAl->addUser($this->security->getUser());
                    $newAl->setIsLiked(true);
                    $newAl->setIsUpvote(false);

                    $em->persist($newAl);
                }
            }

            $em->persist($answer);
            $em->flush();

            return $this->redirectToRoute('showQA', ['id' => $qid]);
        }
    }
}

?>