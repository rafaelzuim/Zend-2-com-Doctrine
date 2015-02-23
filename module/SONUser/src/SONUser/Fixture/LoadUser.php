<?php
namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture ,
    Doctrine\Common\Persistence\ObjectManager;

use SONUser\Entity\User;

class LoadUser extends AbstractFixture
{
    public function load(ObjectManager $manager=null){
        $user = new User();
        $user->setNome("Rafael Caparroz Zuim")
                ->setEmail("rafael.czuim@gmail.com")
                ->setPassword("12345a")
                ->setActive(true);

        $manager->persist($user);
        $manager->flush();
    }
}

