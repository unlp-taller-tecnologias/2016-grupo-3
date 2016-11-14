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
        /*$builder
            ->add('username')
            ->add('password','password')
            ->add('nombre')
            ->add('apellido')
            ->add('dni')
            ->add('cargo')
        ;*/
        $builder
            ->add('username', null, array('label' => 'Usuario'))
            ->add('nombre', null, array('attr' => array('required' => true)))
            ->add('apellido', null, array('attr' => array('required' => true)))
            ->add('dni', null, array('label' => 'D.N.I.', 'attr' => array('required' => true)))
            ->add('cargo', null, array('attr' => array('required' => true)))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las contraseñas deben coincidir.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repetir la contraseña'),
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


