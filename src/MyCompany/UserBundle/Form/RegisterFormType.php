<?php
namespace MyCompany\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
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


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyCompany\UserBundle\Entity\User',
        ));
    }
}