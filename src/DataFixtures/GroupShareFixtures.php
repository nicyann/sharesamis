<?php

namespace App\DataFixtures;

use App\Entity\GroupShare;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class GroupShareFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $groupshare = new GroupShare();
         $groupshare->setName('Les anatolos');
         $groupshare->setDescription('First historic groupshare');
         $groupshare->setIcon('');
         $groupshare->setUser($this->getReference('admin'));
         $manager->persist($groupshare);
         $this->addReference('groupshare', $groupshare);
         
         
         
    
        $groupshare2 = new GroupShare();
        $groupshare2->setName('Suzanne team');
        $groupshare2->setDescription('second group');
        $groupshare2->setIcon('');
        $groupshare2->setUser($this->getReference('user-1'));
        $manager->persist($groupshare2);
        $this->addReference('groupshare-2', $groupshare2);
        
    
        

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(UserFixtures::class,
            );
    }
}
