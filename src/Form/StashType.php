<?php

namespace App\Form;

use App\Entity\Stashs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StashType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('adress')
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Royaume-Uni'=>'united-kingdom',
                    'France'=> 'french',
                    'Espagne'=>'spanish',
                    'Etat-Unis'=>'united-states',
                    'Russie'=>'russia',
                    'Libië'=>'libia',
                    'Australie'=>'australia',
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'maison'=>'home',
                    'bumker'=>'bumker',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stashs::class,
        ]);
    }
}
