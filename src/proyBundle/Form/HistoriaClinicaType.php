<?php

namespace proyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Collections\ArrayCollection;

class HistoriaClinicaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tabaco')
            ->add('alcohol')
            ->add('fechaActualizacion')
            ->add('paciente')
            ->add('medicamentos', 'collection', array('type' => new MedicamentosType(),'allow_add'=>true, 'by_reference'=> false, 'allow_delete'=> true, ))
            ->add('alergias', 'collection', array('type' => new AlergiasType(),'allow_add'=>true, 'by_reference'=> false, 'allow_delete'=> true, ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'proyBundle\Entity\HistoriaClinica'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'proybundle_historiaclinica';
    }
}
