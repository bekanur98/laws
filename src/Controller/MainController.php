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
        return $this->redirectToRoute("showList");
    }

    //Only to show design of these pagesin bil304, will edit later.
    /**
     * @Route("/news", name="showNews")
     */
    public function showNews()
    {
        return $this->render('blocks/news.html.twig');
    }

    /**
     * @Route("/faq", name="showFAQ")
     */
    public function showFAQ()
    {
        return $this->render('blocks/FAQ.html.twig');
    }

}

?>