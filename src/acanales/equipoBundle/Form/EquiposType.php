<?php

namespace acanales\equipoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EquiposType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text', array(
			   'constraints' => array(
				   new NotBlank(),
				   new Length(array('min' => 3)),
			   ),
			 ))
            ->add('division','text')
            ->add('Guardar','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'acanales\equipoBundle\Entity\Equipos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acanales_equipobundle_equipos';
    }
}
