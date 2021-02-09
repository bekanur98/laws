<?php
namespace App\Controller;

use App\Form\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('Default/home.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function new(EntityManagerInterface $em)
    {
        $form = $this->createForm(LoginFormType::class);

        return $this->render('others/login.html.twig', [
            'loginForm' => $form->createView()
        ]);
    }

}

?>