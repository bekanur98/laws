<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function registrationAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm(UserType::class, $user);

//        $user->setRequestedAt(new \Datetime('now'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Yayy! Successfully registrated');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/registration.html.twig', array(
            'signupForm' => $form->createView()
        ));
    }

}