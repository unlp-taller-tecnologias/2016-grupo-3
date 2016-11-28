<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParcialType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',null, array('attr' => array('class' => 'form-control', 'minlength' => '9','maxlength'=>'40','placeholder'=>'Ej: Primer parcial 2016')))
            ->add('descripcion','textarea', array('label'=>'Descripción','attr' => array('class' => 'form-control','minlength' => '10','maxlength'=>'60')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Parcial'
        ));
    }
}
