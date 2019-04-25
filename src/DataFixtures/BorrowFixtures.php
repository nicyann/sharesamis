<?php

namespace App\DataFixtures;

use App\Entity\Borrow;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BorrowFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $borrow = new Borrow();
         $borrow->setDateStart(new \DateTime('2019-04-22'));
         $borrow->setDateEnd(new \DateTime('2019-04-30'));
         $borrow->setReturned('0');
         $borrow->setUser($this->getReference('admin'));
         $borrow->setArticle($this->getReference('article-6'));
         $manager->persist($borrow);
         
         $borrow = new Borrow();
         $borrow->setDateStart(new \DateTime('2019-01-22'));
         $borrow->setDateEnd(new \DateTime('2019-12-31'));
         $borrow->setReturned('0');
         $borrow->setUser($this->getReference('user-3'));
         $borrow->setArticle($this->getReference('article-9'));
         $manager->persist($borrow);
         


        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(UserFixtures::class, ArticleFixtures::class);
    }
}
