<?php

namespace proyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Collections\ArrayCollection;

class PacienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('cedula')
            ->add('fechaNacimiento')
            ->add('direccion')
            ->add('seguroSocial')
            ->add('estado')
            ->add('medicoPreferido')
            ->add('numerosPaciente', 'collection', array('type' => new NumerosPacienteType(),'allow_add'=>true, 'by_reference'=> false, 'allow_delete'=> true, ))
            ->add('contactosEmergencia', 'collection', array('type' => new ContactoEmergenciaType(),'allow_add'=>true, 'by_reference'=> false, 'allow_delete'=> true, ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'proyBundle\Entity\Paciente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'proybundle_paciente';
    }
}
