<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    
    public function __construct(userPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
         $admin = new User();
         $admin->setEmail('yann.nicolle@orange.fr');
         $admin->setFirstname('Yann');
         $admin->setLastname('Nicolle');
         $admin->setPicture('');
         $admin->setPassword($this->passwordEncoder->EncodePassword($admin, 'ynicolle') );
         $admin->setRoles(["ROLE_ADMIN"]);
         $admin->setPhone('0673806527');
         $admin->setAddress('4 rue olympe de gouges');
         $admin->setCity('Sainte Luce sur loire');
         $manager->persist($admin);
         $this->addReference('admin', $admin);
         
         
         
    
    
        $user1 = new User();
        $user1->setEmail('mpy.vasnier@orange.fr');
        $user1->setFirstname('Marie');
        $user1->setLastname('Vasnier');
        $user1->setPicture('');
        $user1->setPassword($this->passwordEncoder->EncodePassword($admin, 'mpyvasnier') );
        $user1->setRoles(["ROLE_USER"]);
        $user1->setPhone('0770025128');
        $user1->setAddress('4 rue olympe de gouges');
        $user1->setCity('Sainte Luce sur loire');
        $manager->persist($user1);
        $this->addReference('user-1', $user1);
    
        
    
        $user2 = new User();
        $user2->setEmail('p.anatole@ogmail.com');
        $user2->setFirstname('Philippe');
        $user2->setLastname('Anatol');
        $user2->setPicture('');
        $user2->setPassword($this->passwordEncoder->EncodePassword($admin, 'panatole') );
        $user2->setRoles(["ROLE_USER"]);
        $user2->setPhone('0770025128');
        $user2->setAddress('9 rue Charles Josse');
        $user2->setCity('Sainte herblain');
        $manager->persist($user2);
        $this->addReference('user-2', $user2);
    
        
    
        $user3 = new User();
        $user3->setEmail('j.doe@ogmail.com');
        $user3->setFirstname('John');
        $user3->setLastname('Doe');
        $user3->setPicture('');
        $user3->setPassword($this->passwordEncoder->EncodePassword($admin, 'jdoe') );
        $user3->setRoles(["ROLE_USER"]);
        $user3->setPhone('0656788985');
        $user3->setAddress('7 rue gambetta');
        $user3->setCity('Nantes');
        $manager->persist($user3);
        $this->addReference('user-3', $user3);
    
        
        
        $manager->flush();
    }
}
