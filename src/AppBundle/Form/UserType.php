<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
//use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends  AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('username', null, array('label' => 'Usuario','attr' => array('class' => 'form-control','minlength' => '3', 'maxlength' => '15')))
            ->add('nombre',null, array('attr' => array('class' => 'form-control', 'minlength' => '3', 'maxlength' => '30')))
            ->add('apellido',null, array('attr' => array('class' => 'form-control','minlength' => '3', 'maxlength' => '30')))
            ->add('dni', null, array('label' => 'D.N.I.','attr' => array('class' => 'form-control')))
            ->add('cargo',null, array('attr' => array('class' => 'form-control','minlength' => '3', 'maxlength' => '30')))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las contraseñas deben coincidir.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Contraseña', 'attr' => array ('class' => 'form-control', 'minlength' => '6')),
                'second_options' => array('label' => 'Repetir la contraseña', 'attr' => array ('class' => 'form-control', 'minlength' => '6')),
            ));
            
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }
}


