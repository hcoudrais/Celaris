<?php

namespace Celaris\Game\Form;

use Celaris\Game\Form\AbstractFormType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class StartGameFormType extends AbstractFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'constraints' => new Assert\NotBlank
            ))
            ->add('race', 'text', array(
                'constraints' => new Assert\NotBlank
            ))
            ->add('faction', 'text', array(
                'constraints' => new Assert\NotBlank
            ))
            ->add('galaxy', 'text', array(
                'constraints' => new Assert\NotBlank
            ))
            ->add('serverName', 'text', array(
                'constraints' => new Assert\NotBlank
            ))
        ;

        parent::buildForm($builder, $options);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'intention'       => 'startGame'
        ));
    }
}
