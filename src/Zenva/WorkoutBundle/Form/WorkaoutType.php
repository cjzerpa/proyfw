<?php

namespace Zenva\WorkoutBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WorkaoutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activity')
            ->add('occurrenceDate')
            ->add('hours')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zenva\WorkoutBundle\Entity\Workaout'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zenva_workoutbundle_workaout';
    }
}
