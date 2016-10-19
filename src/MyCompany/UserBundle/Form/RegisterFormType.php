<?php
namespace MyCompany\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterFormType extends AbstractType
{
/*
 * MyCompany\UserBundle\Form\RegisterFormType: The FormTypeInterface::setDefaultOptions()
 * method is deprecated since version 2.7 and will be removed in 3.0.
 * Use configureOptions() instead. This method will be added to the
 * FormTypeInterface with Symfony 3.0.
 */
	public function getBlockPrefix()
    {
        return 'user_register';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('email', 'Symfony\Component\Form\Extension\Core\Type\EmailType')
            ->add('plainpassword', 'Symfony\Component\Form\Extension\Core\Type\RepeatedType', ["type"=>"Symfony\Component\Form\Extension\Core\Type\PasswordType"])
    	;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyCompany\UserBundle\Entity\User',
        ));
    }
}