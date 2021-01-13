<?php

namespace App\Form;

use App\Entity\Kategori;
use App\Entity\Produk;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProdukType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nama_produk', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('qty', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('Kategori', EntityType::class, [
                'class' => Kategori::class,
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
            'data_class' => Produk::class,
        ]);
    }
}
