<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Contacts;
use App\Entity\Missions;
use App\Entity\Specialitys;
use App\Entity\Stashs;
use App\Entity\Targets;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',null,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('content',null,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('code_name',null,[
                'attr'=>['class'=>'form-control']
            ])
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
                'attr'=>['class'=>'form-control']
            ])
            ->add('type',null,[
                'attr'=>['class'=>'form-control']
            ])
            ->add('start_date')
            ->add('end_date')
            ->add('specialitys',EntityType::class, [
                'class'=>Specialitys::class,
                'choice_label'=>'name',
                'label'=>'spécialité',
                'multiple'=>true,
                'attr'=> ['class'=>'form-select mr-1']
            ])
            ->add('agents',EntityType::class, [
                'class'=>Agents::class,
                'choice_label'=>function($agent){
                    $agentSpeciality = [];
                    foreach($agent->getSpecialitys() as $speciality){
                        $agentSpeciality[] = $speciality->getName();
                    }
                    return 'Nom/Prenom: '.ucfirst($agent->getLastName()).' '.ucfirst($agent->getFirstName()).' - Nationalité: '.$agent->getCountry().' - Spécialité: '.implode(',',$agentSpeciality);
                },
                'label'=>'Agents',
                'multiple'=>true,
                'attr'=> ['class'=>'form-select mr-1']
            ])
            ->add('targets',EntityType::class, [
                'class'=>Targets::class,
                'choice_label'=>function($target){
                    return ucfirst($target->getLastName()).' '.ucfirst($target->getFirstName()).' - '.$target->getCountry();
                },
                'label'=>'Cibles',
                'multiple'=>true,
                'attr'=> ['class'=>'form-select mr-1']
            ])
            ->add('contacts',EntityType::class, [
                'class'=>Contacts::class,
                'choice_label'=>function($contact){
                    return ucfirst($contact->getLastName()).' '.ucfirst($contact->getFirstName()).' - '.$contact->getCountry();
                },
                'label'=>'Contacts',
                'multiple'=>true,
                'attr'=> ['class'=>'form-select mr-1']
            ])
            ->add('stashs',EntityType::class, [
                'class'=>Stashs::class,
                'choice_label'=>function($stash){
                    return $stash->getCode().' : '.$stash->getAdress().' '.$stash->getCountry();
                },
                'label'=>'Planques',
                'multiple'=>true,
                'attr'=> ['class'=>'form-select mr-1']
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
