<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    public function registrationAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm('App\Form\LoginFormType', $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() & $form->isValid()){

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()))

            $em->persist($user);
            $em->flush();
        }

        return $this->render('others/login.html.twig', array(
            'loginForm' => $form->createView()
        ));
    }

}