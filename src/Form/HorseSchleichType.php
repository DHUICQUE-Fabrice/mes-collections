<?php

namespace App\Form;

use App\Entity\HorseCoat;
use App\Entity\HorseSchleich;
use App\Entity\HorseSpecies;
use App\Entity\HorseType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HorseSchleichType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label'=>'Veuillez ajouter une photo (facultatif, maximum 2Mb)',
                'required'=>false,
                'allow_delete' => false
            ])
            ->add('name', null, [
                'label'=>'Nom : '
            ])
            ->add('biography', TextareaType::class, [
                'label'=>'Biographie : ',
            ])
            ->add('type', EntityType::class, [
                'class'=>HorseType::class,
                'choice_label'=>'name',
                'label'=>'Type : ',
                'placeholder'=>'Sélectionnez'
            ])
            ->add('coat', EntityType::class, [
                'class'=>HorseCoat::class,
                'choice_label'=>'name',
                'label'=>'Robe : ',
                'placeholder'=>'Sélectionnez'
            ])
            ->add('species', EntityType::class, [
                'class'=>HorseSpecies::class,
                'choice_label'=>'name',
                'label'=>'Race : ',
                'placeholder'=>'Sélectionnez'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HorseSchleich::class,
        ]);
    }
}
