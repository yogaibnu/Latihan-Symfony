<?php

namespace App\Form;

use App\Entity\Kategori;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KategoriType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nama_kategori', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Kategori::class,
        ]);
    }
}
