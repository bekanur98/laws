<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\ResetPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetController extends AbstractController
{

    /**
     * @Route("/reset-password-by-email/{id}", name="resetPassword")
     */
    public function resetPassword(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        return $this->render('security/reset_password.html.twig', ['user' => $user, 'error' => 0]);
    }

    /**
     * @Route("/update", name="updatePassword")
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder) {

        $em = $this->getDoctrine()->getManager();
        $id = $request->request->get('id');
        $user = $em->getRepository(User::class)->find($id);

        $pass1 = $request->request->get('password1');
        $pass2 = $request->request->get('password2');

        if($pass1 != $pass2) {
            return $this->render('security/reset_password.html.twig', ['user' => $user, 'error' => 1]);
        }

        $password = $pass1;

        $user->setPassword($encoder->encodePassword($user, $password));

        $em->persist($user);
        $em->flush();

        $this->addFlash(
            'success',
            $user->getUsername().'\'s password successfully updated!'
        );

//        $user = $em->getRepository(User::class)->find($id);

        return $this->redirectToRoute('index');
    }
}