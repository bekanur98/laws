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
            ->add('email', EmailType::class, ['label' => 'Эл. почта'])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Пароль'),
                'second_options' => array('label' => 'Повторите пароль'),
            ))
            ->add('username', TextType::class, ['label' => 'Ник'])
            ->add('first_name', TextType::class, ['label' => 'Имя'])
            ->add('last_name', TextType::class, ['label' => 'Фамилия'])
            ->add('gender', ChoiceType::class, [
                'label' => 'Пол',
                'choices' => [
                    'Муж.' => true,
                    'Жен.' => false
                ]
            ])
            ->add('phone_number', TextType::class, ['label' => 'Номер телефона'])
            ->add('is_lawyer', CheckboxType::class, ['label' => 'Юрист'])
            ->add('law_licence_no', TextType::class, ['label' => 'Номер лицензии'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=> User::class
        ]);
    }
}