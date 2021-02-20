<?php


namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\Security\Core\User\User;
use function Sodium\add;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('id', HiddenType::class)
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class
            ])
            ->add('username', TextType::class)
            ->add('first_name')
            ->add('last_name')
            ->add('phone_number')
            ->add('is_locked', HiddenType::class, [
                'data'=>true
            ])
            ->add('confirmation_token', HiddenType::class, [
                'data'=>'1'
            ])
//            ->add('requested_at', HiddenType::class, [
//                'data'=>''
//            ])
            ->add('requested_at')
            ->add('is_lawyer')
            ->add('law_licence_no')
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success pull-right'
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=> User::class
        ]);
    }
}