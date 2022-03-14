<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nickname', null,[
                'label' => 'Pseudo'
            ])
            ->add('email')
            ->add('about', null, [
                'label' => "A propos de moi",
                'attr' => array(
                    'placeholder' => 'J\'adore collectionner les Petshops !',
                    'rows' => 5
                )
            ])
//            ->add('imageFile', VichImageType::class,[
//                'label' => 'Avatar',
//                'allow_delete' => false,
//                'download_link' => false
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
