<?php

namespace Celaris\Game\Form;

use Celaris\Game\Form\AbstractFormType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ServerFormType extends AbstractFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'constraints' => new Assert\NotBlank
            ))
        ;

        parent::buildForm($builder, $options);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'      => 'Celaris\Site\Entity\Server',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'intention'       => 'server'
        ));
    }
}
