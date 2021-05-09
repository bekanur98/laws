<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NotLawyersController extends AbstractController {
    /**
     * @Route("/notLawyers/alph", name="notLawyersAlph")
     */
    public function showLawyersAlph() {
        $em = $this->getDoctrine()->getManager();
        $lawyers = $em->getRepository(User::class)->findNotLawyersByAlph();

        return $this->render('Layouts/lawyers/notLawyers_alph.html.twig', ['lawyers'=>$lawyers]);
    }

    /**
     * @Route("/notLawyers/rating", name="notLawyersByRating")
     */
    public function showLawyersByRating() {
        $em = $this->getDoctrine()->getManager();
        $lawyers = $em->getRepository(User::class)->findNotLawyersByRating();

        return $this->render('Layouts/lawyers/notLawyers_rating.html.twig', ['lawyers'=>$lawyers]);
    }

    /**
     * @Route("/notLawyers/reg", name="notLawyersReg")
     */
    public function showLawyersReg() {
        $em = $this->getDoctrine()->getManager();
        $lawyers = $em->getRepository(User::class)->findNotLawyersByRegTime();

        return $this->render('Layouts/lawyers/notLawyers_reg.html.twig', ['lawyers'=>$lawyers]);
    }
}

?>