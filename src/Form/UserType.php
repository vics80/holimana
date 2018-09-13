<?php

namespace App\Form;

use Holimana\Domain\Role\Role;
use Holimana\Domain\User\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add(
                'role',
                EntityType::class,
                [
                    'class' => Role::class,
                    'choice_label' => 'name'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
