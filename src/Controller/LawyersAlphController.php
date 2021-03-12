<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LawyersAlphController extends AbstractController {
    /**
     * @Route("/lawyers_alph", name="lawyersAlph")
     */
    public function showLawyersAlph() {
        $repos = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repos->findLawyersByAlph();

        return $this->render('Blocks/lawyers_alph.html.twig', ['lawyers'=>$lawyers]);
    }
}
?>