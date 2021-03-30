<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Tag;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title_question', TextType::class, ['label' => 'Название вопроса'])
            ->add('body_question', TextType::class, ['label' => 'Контент вопроса'])
            ->add('submit', SubmitType::class, [
                'label' => 'Задать вопрос',
                'attr' => [
                    'class' => 'btn btn-success pull-right'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Question::class
        ]);
    }

}

?>