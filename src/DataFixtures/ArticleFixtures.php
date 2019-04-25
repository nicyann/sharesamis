<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setName('Appareil à raclette');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-2'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-8'));
        $article->setStatus($this->getReference('status-2'));
        $this->addReference('article-1', $article);
        $manager->persist($article);
        
        $article = new Article();
        $article->setName('GoPro');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-3'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-7'));
        $article->setStatus($this->getReference('status-1'));
        $this->addReference('article-2', $article);
        $manager->persist($article);
        
        $article = new Article();
        $article->setName('Karcher');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-2'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-1'));
        $article->setStatus($this->getReference('status-2'));
        $this->addReference('article-3', $article);
        $manager->persist($article);
        
        
        $article = new Article();
        $article->setName('Décolleuse');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-2'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-1'));
        $article->setStatus($this->getReference('status-2'));
        $this->addReference('article-4', $article);
        $manager->persist($article);
        
        
        $article = new Article();
        $article->setName('Scie circulaire');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-3'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-1'));
        $article->setStatus($this->getReference('status-2'));
        $this->addReference('article-5', $article);
        $manager->persist($article);
        
        $article = new Article();
        $article->setName('remorque');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-2'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-1'));
        $article->setStatus($this->getReference('status-1'));
        $this->addReference('article-6', $article);
        $manager->persist($article);
        
        $article = new Article();
        $article->setName('Lit parapluie');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-1'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-6'));
        $article->setStatus($this->getReference('status-2'));
        $this->addReference('article-7', $article);
        $manager->persist($article);
        
        $article = new Article();
        $article->setName('Playstation 4');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-3'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-5'));
        $article->setStatus($this->getReference('status-2'));
        $this->addReference('article-8', $article);
        $manager->persist($article);
        
        $article = new Article();
        $article->setName('Poussette');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-1'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-6'));
        $article->setStatus($this->getReference('status-1'));
        $this->addReference('article-9', $article);
        $manager->persist($article);
        
        $article = new Article();
        $article->setName('L\'écume des jours(Boris Vian)');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('user-1'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-4'));
        $article->setStatus($this->getReference('status-2'));
        $this->addReference('article-10', $article);
        $manager->persist($article);
        
        $article = new Article();
        $article->setName('Combinaison de ski');
        $article->setDescription('');
        $article->setPicture('');
        $article->setUser($this->getReference('admin'));
        $article->setType($this->getReference('type-1'));
        $article->setCategory($this->getReference('category-3'));
        $article->setStatus($this->getReference('status-2'));
        $this->addReference('article-11', $article);
        $manager->persist($article);
       
        

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(UserFixtures::class,TypeFixtures::class,
            CategoryFixtures::class,StatusFixtures::class);
    }
}
