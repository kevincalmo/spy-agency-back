<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Specialitys;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('last_name')
            ->add('first_name')
            ->add('birth_date')
            ->add('code_auth')
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
            ->add('specialitys', EntityType::class, [
                'class'=>Specialitys::class,
                'choice_label'=> 'name',
                'label'=>'Spcialité',
                'multiple'=>true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agents::class,
        ]);
    }
}
