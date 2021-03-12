<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LawyersRatingController extends AbstractController {
    /**
     * @Route("/lawyers_rating", name="lawyersByRating")
     */
    public function showLawyersByRating() {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repository->findLawyersByRating();

        // пока все рейтинги равны нулю

        return $this->render('Blocks/lawyers_rating.html.twig', ['lawyers'=>$lawyers]);
    }
}

?>