<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InstanciaParcialType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',null, array('attr' => array('class' => 'form-control', 'minlength' => '10','maxlength'=>'40')))
            ->add('descripcion','textarea', array('attr' => array('class' => 'form-control', 'minlength' => '10','maxlength'=>'60')))
            ->add('fechaInicio', DateType::class, array('required' => true,'widget' => 'single_text','attr' => array('class' => 'form-control','min' => date('Y-m-d'))))
            ->add('fechaFin', DateType::class, array('required' => false,'widget' => 'single_text','attr' => array('class' => 'form-control','min' => date('Y-m-d'))))
            ->add('estado', ChoiceType::class, 
                    array( 'choices'  => array (
                        'pendiente' => 'pendiente',
                        'suspendido' => 'suspendido',
                        'finalizado' => 'finalizado', 
                        ),'attr' => array('class' => 'form-control')
                    )
                )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InstanciaParcial'
        ));
    }
}
