<?php

namespace MyCompany\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        //$em = $this->container->get('doctrine')->getEntityManager();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('MyCompanyArticleBundle:Article');
        $article = $repo->findOneBy(
            ["name" => "vest"]
        );
        return $this->render(
            'MyCompanyArticleBundle:Default:index.html.twig',
            ["article" => $article]
        );
    }
}
