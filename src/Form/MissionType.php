<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Contacts;
use App\Entity\Missions;
use App\Entity\Specialitys;
use App\Entity\Stashs;
use App\Entity\Targets;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('code_name')
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
            ->add('type')
            ->add('start_date')
            ->add('end_date')
            ->add('specialitys',EntityType::class, [
                'class'=>Specialitys::class,
                'choice_label'=>'name',
                'label'=>'spécialité',
                'multiple'=>true
            ])
            ->add('agents',EntityType::class, [
                'class'=>Agents::class,
                'choice_label'=>function($agent){
                    return ucfirst($agent->getLastName()).' '.ucfirst($agent->getFirstName()).' - '.$agent->getCountry();
                },
                'label'=>'Agents',
                'multiple'=>true,
            ])
            ->add('targets',EntityType::class, [
                'class'=>Targets::class,
                'choice_label'=>function($target){
                    return ucfirst($target->getLastName()).' '.ucfirst($target->getFirstName()).' - '.$target->getCountry();
                },
                'label'=>'Cibles',
                'multiple'=>true,
            ])
            ->add('contacts',EntityType::class, [
                'class'=>Contacts::class,
                'choice_label'=>function($contact){
                    return ucfirst($contact->getLastName()).' '.ucfirst($contact->getFirstName()).' - '.$contact->getCountry();
                },
                'label'=>'Contacts',
                'multiple'=>true,
            ])
            ->add('stashs',EntityType::class, [
                'class'=>Stashs::class,
                'choice_label'=>function($stash){
                    return $stash->getCode().' : '.$stash->getAdress().' '.$stash->getCountry();
                },
                'label'=>'Planques',
                'multiple'=>true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
