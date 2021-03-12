<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Mailer\TwigSwiftMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Twig\Environment;

class RegistrationController extends AbstractController
{

    /**
     * @var TwigSwiftMailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }


    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function registrationAction(Request $request,
                                       UserPasswordEncoderInterface $encoder
                                       )
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->add('submit', SubmitType::class, [
            'label' => 'Регистрация',
            'attr' => [
                'class' => 'btn btn-success pull-right'
            ]
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $csrfToken = $this->has('security.csrf.token_manager')
                ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
                : null;
            $user->setConfirmationToken($csrfToken);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Yayy! Successfully registrated');

            return $this->redirectToRoute('showList');

//            return $this->render('Default/home.html.twig', [
//                'email' => $user->getEmail()
//            ]);

        }

        return $this->render('security/registration.html.twig', array(
            'form' => $form->createView()
        ));


    }

    public function checkConfirmationToken(Request $request){

        $em = $this->getDoctrine()->getManager();

        $id = $request->request->get('id');

        $user = $em->getRepository(User::class)->find($id);

        if ($user->getConfirmationToken() == $request->request->get('confirmationToken')){
            $user->setIsLocked(false);
            $user->setConfirmationToken(null);
            $em->persist($user);
            $em->flush();
        }

    }


}