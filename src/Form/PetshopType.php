<?php

namespace App\Form;

use App\Entity\Petshop;
use App\Entity\PetshopSize;
use App\Entity\PetshopSpecies;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PetshopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Nom : '
            ])
            ->add('biography', TextareaType::class, [
                'label'=>'Biographie : ',
            ])
            ->add('size', EntityType::class,[
                'class'=>PetshopSize::class,
                'choice_label'=>'name',
                'label'=>'Taille : ',
                'placeholder'=>'Sélectionnez'
            ])
            ->add('species', EntityType::class,[
                'class'=>PetshopSpecies::class,
                'choice_label'=>'name',
                'label'=>'Animal : ',
                'placeholder'=>'Sélectionnez'
            ])->add('imageFile', ImageFileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Petshop::class,
        ]);
    }
}
