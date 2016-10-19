<?php
namespace MyCompany\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;  
use MyCompany\UserBundle\Entity\User;
use MyCompany\UserBundle\Form\RegisterFormType;
class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('MyCompany\UserBundle\Form\RegisterFormType', $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            //$user->setUsername($data['username']);
            //$user->setEmail($data['email']);
            $user->setPassword($this->encodePassword($user, $user->getPlainPassword() ));
            $user->setRoles(['ROLE_USER']);
            //$user->setIsActive(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush(); 
            
            $url = $this->generateUrl('news_index');
            return $this->redirect($url);                        
        }
        return array('form' => $form->createView());
    }

    private function encodePassword(User $user, $plainPassword) {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }    
}