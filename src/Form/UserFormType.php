<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Vich\UploaderBundle\Form\Type\VichImageType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            // ->add('imageFile', VichImageType::class, [
            //     'required' => false,
            //     'allow_delete' => true,
            //     'delete_label' => '...',
            //     'download_label' => '...',
            //     'download_uri' => true,
            //     'image_uri' => true,
            //     'imagine_pattern' => '...',
            //     'asset_helper' => true,
            // ]);
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer la photo de profil',
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
