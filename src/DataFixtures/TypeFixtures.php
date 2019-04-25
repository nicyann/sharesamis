<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $type = new Type();
         $type->setName('personnel');
         $type->setIcon('');
         $this->addReference('type-1', $type);
         $manager->persist($type);
    
        $type = new Type();
        $type->setName('commun');
        $type->setIcon('');
        $this->addReference('type-2', $type);
        $manager->persist($type);

        $manager->flush();
    }
}
