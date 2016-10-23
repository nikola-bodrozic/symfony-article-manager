<?php
namespace MyCompany\ArticleBundle\Reporting;

    class EventReportManager
    {
        /*
        private $em;
        public function __construct($em)
        {
            $this->em = $em;
        }
        */
        public function getRecentlyUpdatedReport()
        {
            $em = $this->getDoctrine()->getManager();

            $events = $em->getRepository('MyCompanyArticleBundle:Article')
                ->getRecentlyUpdatedEvents();

            $rows = array();
            foreach ($events as $event) {
                $data = array($event->getId(), $event->getName());

                $rows[] = implode(',', $data);
            }

            return implode("\n", $rows);
        }
    }