<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MemberFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $member = new Member();
        $member->setUser($this->getReference('admin'));
        $member->setGroupShare($this->getReference('groupshare'));
        $member->setIsValid('1');
        $this->addReference('member-1', $member);
        $manager->persist($member);
    
        $member1 = new Member();
        $member1->setUser($this->getReference('user-1'));
        $member1->setGroupShare($this->getReference('groupshare'));
        $member1->setIsValid('1');
        $this->addReference('member-2', $member1);
        $manager->persist($member1);
    
        $member = new Member();
        $member->setUser($this->getReference('user-2'));
        $member->setGroupShare($this->getReference('groupshare'));
        $member->setIsValid('1');
        $this->addReference('member-3', $member);
        $manager->persist($member);

        $manager->flush();
    }
    
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return array(UserFixtures::class,
            GroupShareFixtures::class
            );
        
    }
}
