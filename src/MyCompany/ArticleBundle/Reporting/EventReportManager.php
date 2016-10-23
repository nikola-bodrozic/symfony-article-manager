<?php
namespace MyCompany\ArticleBundle\Reporting;

class EventReportManager
{
    
    private $em;
    public function __construct($em)
    {
        $this->em = $em;
    }
    
    public function getRecentlyUpdatedReport()
    {
        $articles = $this->em->getRepository('MyCompanyArticleBundle:Article')
                           ->getRecentlyUpdatedArticles()
        ;

        $rows = array();
        foreach ($articles as $article) {
            $data = array($article->getId(), $article->getName());

            $rows[] = implode(',', $data);
        }

        return implode("\n", $rows);
    }
}