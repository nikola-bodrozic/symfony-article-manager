<?php

namespace MyCompany\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    /**
     * @Route("/articles/report/recentlyUpdated.csv")
     */
    public function updatedArticlesAction()
    {
    	$em = $this->getDoctrine()->getManager();
		$articles = $em->getRepository('MyCompanyArticleBundle:Article')
		             ->getRecentlyUpdatedArticles()
		;
		$rows = array();
        foreach ($articles as $ev) {
            $data = array($ev->getId(), $ev->getName(), $ev->getTime()->format('Y-m-d H:i:s'));
            $rows[] = implode(',', $data);
        }

        $content = implode("\n", $rows);
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');
        return $response;        
    }

}
