<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                    'placeholder' => 'J\'adore collectionner !',
                    'rows' => 5
                )
            ])->add('imageFile', ImageFileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
