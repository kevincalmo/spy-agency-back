<?php

namespace App\Form;

use App\Entity\Administrator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $date = date('Y-m-d');
        dump($date);
        
        $builder
            ->add('email')
            ->add('roles',ChoiceType::class,[
                'choices'=> [
                    'Utilisateur'=>'ROLE_USER',
                    'Administrateur'=>'ROLE_ADMIN'
                ],
                'expanded'=>true,
                'multiple'=>true
            ])
            ->add('password', PasswordType::class)
            ->add('last_name')
            ->add('first_name')
            ->add('created_at', HiddenType::class,[
                'data'=> $date,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Administrator::class,
        ]);
    }
}
