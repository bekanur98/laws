<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LawyersController extends AbstractController {
    /**
     * @Route("/lawyers/alph", name="lawyersAlph")
     */
    public function showLawyersAlph() {
        $repos = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repos->findLawyersByAlph();

        return $this->render('Layouts/lawyers/lawyers_alph.html.twig', ['lawyers'=>$lawyers]);
    }

    /**
     * @Route("/lawyers/rating", name="lawyersByRating")
     */
    public function showLawyersByRating() {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repository->findLawyersByRating();

        return $this->render('Layouts/lawyers/lawyers_rating.html.twig', ['lawyers'=>$lawyers]);
    }

    /**
     * @Route("/lawyers/reg", name="lawyersReg")
     */
    public function showLawyersReg() {
        $repos = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repos->findLawyersByRegTime();

        return $this->render('Layouts/lawyers/lawyers_reg.html.twig', ['lawyers'=>$lawyers]);
    }
}
?>