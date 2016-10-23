<?php

namespace MyCompany\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use MyCompany\ArticleBundle\Reporting\EventReportManager;

class ReportController extends Controller
{
    /**
     * @Route("/articles/report/recentlyUpdated.csv")
     */
    public function updatedArticlesAction()
    {
    	$eventReportManager = $this->container->get('event_report_manager');

    	$content = $eventReportManager->getRecentlyUpdatedReport();
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');
        return $response;   
    }

}
