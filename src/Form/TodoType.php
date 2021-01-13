<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('person', EntityType::class, [
                'class' => Person::class,
                'attr' => ['class' => 'form-control']
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-3']
            ])
        ;
    }
}
