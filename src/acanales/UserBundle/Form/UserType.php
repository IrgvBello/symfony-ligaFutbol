<?php

namespace acanales\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email','email', array(
			   'constraints' => array(
				   new NotBlank(),
				   new Length(array('min' => 3)),
			   ),
			 ))
            ->add('username','text', array(
			   'constraints' => array(
				   new NotBlank(),
				   new Length(array('min' => 3)),
			   ),
			 ))
            ->add('password','password', array(
			   'constraints' => array(
				   new NotBlank(),
				   new Length(array('min' => 3)),
			   ),
			 ))
			->add('Nuevo usuario','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'acanales\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acanales_userbundle_user';
    }
}
