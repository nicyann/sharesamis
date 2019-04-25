<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
         $category = new Category();
         $category->setName('Bricolage');
         $this->addReference('category-1', $category);
         $manager->persist($category);
    
        $category = new Category();
        $category->setName('Jardinage');
        $this->addReference('category-2', $category);
        $manager->persist($category);
    
        $category = new Category();
        $category->setName('Vetements');
        $this->addReference('category-3', $category);
        $manager->persist($category);
    
        $category = new Category();
        $category->setName('Livres');
        $this->addReference('category-4', $category);
        $manager->persist($category);
    
        $category = new Category();
        $category->setName('Jeux');
        $this->addReference('category-5', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Périculture');
        $this->addReference('category-6', $category);
        $manager->persist($category);
        
        $category = new Category();
        $category->setName('Sport');
        $this->addReference('category-7', $category);
        $manager->persist($category);
        
        $category =new Category();
        $category->setName('Cuisine');
        $this->addReference('category-8', $category);
        $manager->persist($category);
        
        
         
        
        $manager->flush();
    }
}
