<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $status = new Status();
         $status->setLabel('En prêt');
         $this->addReference('status-1', $status);
         $manager->persist($status);
    
        $status = new Status();
        $status->setLabel('Disponible');
        $this->addReference('status-2', $status);
        $manager->persist($status);
        
        $manager->flush();
    }
}
