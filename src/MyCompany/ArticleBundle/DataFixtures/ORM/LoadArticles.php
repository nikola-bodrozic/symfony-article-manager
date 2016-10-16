<?php
namespace MyCompany\MyComanyArticleBundle\ArticleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MyCompany\ArticleBundle\Entity\Article;
class LoadEvents implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $article1 = new Article();
        $article1->setName('Darth\'s Birthday Party!');
        $article1->setLocation('Deathstar');
        $article1->setTime(new \DateTime('tomorrow noon'));
        $article1->setDetails('Ha! Darth HATES surprises!!!');
        $manager->persist($article1);

        $article2 = new Article();
        $article2->setName('Rebellion Fundraiser Bake Sale!');
        $article2->setLocation('Endor');
        $article2->setTime(new \DateTime('Thursday noon'));
        $article2->setDetails('Ewok pies! Support the rebellion!');
        $manager->persist($article2);

        // the queries aren't done until now
        $manager->flush();
    }
}