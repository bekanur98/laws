<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LawyersController extends AbstractController {
    /**
     * @Route("/lawyers_alph", name="lawyersAlph")
     */
    public function showLawyersAlph() {
        $repos = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repos->findLawyersByAlph();

        return $this->render('Layouts/lawyers/lawyers_alph.html.twig', ['lawyers'=>$lawyers]);
    }

    /**
     * @Route("/lawyers_rating", name="lawyersByRating")
     */
    public function showLawyersByRating() {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repository->findLawyersByRating();

        // пока все рейтинги равны нулю

        return $this->render('Layouts/lawyers/lawyers_rating.html.twig', ['lawyers'=>$lawyers]);
    }

    /**
     * @Route("/lawyers_reg", name="lawyersReg")
     */
    public function showLawyersReg() {
        $repos = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repos->findLawyersByRegTime();

        return $this->render('Layouts/lawyers/lawyers_reg.html.twig', ['lawyers'=>$lawyers]);
    }
}
?>