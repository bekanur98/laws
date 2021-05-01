<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Mailer\TwigSwiftMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ForgotPasswordController extends AbstractController {

    /**
     * @Route ("/forgot_password", name = "redirectToForgPass")
     */
    public function redirectToForgPass() {
        return $this->render('security/forgotPass.html.twig');
    }

    /**
     * @Route ("/send_code", name = "sendVerificationCode")
     */
    public function sendEmail(\Swift_Mailer $mailer, Request $request) {
        $email = $request->request->get('email');

        $message = (new \Swift_Message('Email'))
            ->setFrom('1804.01023@manas.edu.kg')
            ->setTo(''.$email)
            ->setBody(
                $this->renderView('emails/forgotPass.html.twig'),
                'text/html'
            )
        ;

        $mailer->send($message);

        return $this->render('security/sendVerifCode.html.twig', ['email'=>$email]);
    }

//    public function updatePassword(Request $request) {
//        $em = $this->getDoctrine()->getManager();
//
//        $user = $em->getRepository(User::class)->findOneBy($email);
//
//        $form = $this->createForm(ResetPasswordType::class, $user);
//
//        $form->handleRequest($request);
//
//        if($form->isSubmitted() && $form->isValid()) {
//
//        }
//    }
}

?>