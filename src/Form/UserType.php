<?php


namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('email', EmailType::class, ['label' => 'Email*'])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Password*'),
                'second_options' => array('label' => 'Confirm Password*'),
            ))
            ->add('username', TextType::class, ['label' => 'Username*'])
            ->add('first_name', TextType::class, ['label' => 'Name*'])
            ->add('last_name', TextType::class, ['label' => 'Surname*'])
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender',
                'choices' => [
                    'Male' => true,
                    'Female' => false
                ]
            ])
            ->add('phone_number', TextType::class, ['label' => 'Phone number','required' => false])
            ->add('is_lawyer', CheckboxType::class, ['label' => 'Lawyer','required' => false])
            ->add('law_licence_no', TextType::class, ['label' => 'Licence No.','required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=> User::class
        ]);
    }
}