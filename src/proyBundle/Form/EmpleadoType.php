<?php

namespace proyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpleadoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user')
            ->add('password','repeated',array(
                'type'=>'password',
                'first_name'=>'Contrasena',
                'second_name'=>"Confirmar-Contrasena",
                'invalid_message'=>'No coincide',
                'required'=>'true',
                'options' => array('attr' => array('class' => 'password-field'))))
            ->add('nombre')
            ->add('apellido')
            ->add('fechaNacimiento')
            ->add('numeroSeguro')
            ->add('direccion')
            ->add('telefono')
            ->add('fechaInicio')
            ->add('cargo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'proyBundle\Entity\Empleado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'proybundle_empleado';
    }
}
