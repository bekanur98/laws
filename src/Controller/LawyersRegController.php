<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LawyersRegController extends AbstractController {
    /**
     * @Route("/lawyers_reg", name="lawyersReg")
     */
    public function showLawyersReg() {
        $repos = $this->getDoctrine()->getRepository(User::class);
        $lawyers = $repos->findLawyersByRegTime();

        return $this->render('Blocks/lawyers_reg.html.twig', ['lawyers'=>$lawyers]);
    }
}
?>