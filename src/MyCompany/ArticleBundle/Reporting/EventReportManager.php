<?php
namespace MyCompany\ArticleBundle\Reporting;
use Doctrine\ORM\EntityManager;
class EventReportManager
{
    
    private $em;
    public function __construct(EntityManager $em)
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