<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,["label"=>"Titre"])
            ->add('videoLink', TextType::class, [
                'label' => 'Lien vidéo (YouTube)',
            ])
            ->add('description',TextType::class,["label"=>"Description"])
            ->add('premiumVideo',CheckboxType::class,["label"=>"Une vidéo premium?"])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}