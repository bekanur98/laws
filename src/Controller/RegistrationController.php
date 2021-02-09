<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends AbstractController
{
    public function registrationAction(Request $request)
    {
        $user = new User();


        $form->handleRequest($request);

        if ($form->isSubmitted() & $form->isValid()){

        }
    }

}