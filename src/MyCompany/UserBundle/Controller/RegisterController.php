<?php
namespace MyCompany\UserBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction()
    {
        $form = $this->createFormBuilder()
            ->add('username', 'text')
            ->add('email', 'text')
            ->add('password', 'password')
            ->getForm()
        ;
        return array('form' => $form->createView());
    }
}