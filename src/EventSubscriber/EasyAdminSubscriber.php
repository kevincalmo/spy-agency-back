<?php
namespace App\EventSubscriber;

use App\Entity\Missions;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setMissions'],
        ];
    }

    public function setMissions(BeforeEntityUpdatedEvent $event)
    {
        $mission = $event->getEntityInstance();
            
        if(!$mission instanceof Missions){
            return;
        }

        /*========== Phase de test des difféérentes données  ==========*/
            $errorsForm = [];


            /* Les agents et les cibles sont de nationalités différentes */
            /* il faut assigner au moins un agent avec la spécialité demandé dans la mission */
            $nbr_agent_with_speciality = 0;
            $nbr_agents_targets_same_nationality = 0;
            /* foreach ($mission->getAgents() as $agent) {
                foreach ($mission->getTargets() as $target) {
                }
                if ($mission->getSpecialitys()->count() === 1) {
                    dump("ok");
                    foreach ($mission->getSpecialitys() as $missionSpecility) {
                        dump($missionSpecility->getName());
                        foreach ($agent->getSpecialitys() as $agentSpeciality) {
                        }
                    }
                }
            } */

            if ($mission->getSpecialitys()->count() === 1) {
                foreach ($mission->getSpecialitys() as $missionSpecility) {
                    foreach ($mission->getAgents() as $agent) {
                        foreach ($agent->getSpecialitys() as $agentSpeciality) {
                            if ($missionSpecility->getName() === $agentSpeciality->getName()) {
                                $nbr_agent_with_speciality++;
                            }
                        }
                        foreach ($mission->getTargets() as $target) {
                            if ($agent->getCountry() === $target->getCountry()) {
                                $nbr_agents_targets_same_nationality++;
                            }
                        }
                    }
                }
            }

            if ($mission->getSpecialitys()->count() > 1) array_push($errorsForm, "Vous ne pouvez choisir qu'une seule spécialité pour la mission");
            if ($nbr_agents_targets_same_nationality !== 0) array_push($errorsForm, 'Les agents et les cibles ne peuvent avoir la même nationalité, veuillez changer d\'agents ou de cibles!');
            if ($nbr_agent_with_speciality === 0 && $mission->getSpecialitys()->count() === 1) array_push($errorsForm, "Aucun agent sélectionné ne possède la spécialité requise pour cette mission");

            /* les contacts sont obligatoirement de la nationalité de la mission */
            $nbr_contact = 0;
            foreach ($mission->getContacts() as $contact) {
                if ($contact->getCountry() !== $mission->getCountry()) $nbr_contact++;
            }
            if ($nbr_contact > 0) array_push($errorsForm, "Veuillez choisir des contacts ayant la nationalité du lieu me mission");

            /* Les planques sont obilgatoirement dans le même pays que la mission */
            $nbr_stashs = 0;
            foreach ($mission->getStashs() as $stash) {
                if ($stash->getCountry() !== $mission->getCountry()) $nbr_stashs++;
            }
            if ($nbr_stashs > 0) array_push($errorsForm, "Veuillez choisir des planques présentent dans le pays de mission");


            dd($errorsForm);
    }
}