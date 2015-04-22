<?php

namespace proyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class VisitasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('hora')
            ->add('altura')
            ->add('peso')
            ->add('presionArterial')
            ->add('frecuenciaCardiaca')
            ->add('temperatura')
            ->add('diagnostico')
            ->add('medico')
            ->add('empleados')
            ->add('historiaClinica')
            ->add('recetas', 'collection', array('type' => new RecetasType(),'allow_add'=>true, 'by_reference'=> false, 'allow_delete'=> true, ))
            ->add('referencias', 'collection', array('type' => new ReferenciasType(),'allow_add'=>true, 'by_reference'=> false, 'allow_delete'=> true, ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'proyBundle\Entity\Visitas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'proybundle_visitas';
    }
}
