<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class Load_3_UserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
//        $client1 = $this->getReference('client-1');
//        $client2 = $this->getReference('client-2');

        $profileJefeTienda = $this->getReference('profile-jefe-tienda');
        $profileJefeLogistica = $this->getReference('profile-jefe-logistica');
        $profileEncargadoAlmacen = $this->getReference('profile-encargado-almacen');

        $entity = new User();
//        $entity->setClient($client1);
//        $entity->setCode('Z1234');
        $entity->setDni('12345678');
        $entity->setPassword('123');
        $entity->setName('Alan');
        $entity->setLastName('Garcia');
        $entity->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuvnD8Z4Y8HdRYoidxmHLl7G_u8551SRmPjlEY_Hnz-YEuU-OF');
        $entity->setEmail('test@gmail.com');
        $entity->setIsActive(true);
        $entity->setProfile($profileJefeTienda);
        $manager->persist($entity);

        $entity = new User();
//        $entity->setClient($client2);
//        $entity->setCode('V6655');
        $entity->setDni('44443333');
        $entity->setPassword('123');
        $entity->setName('Leoncio');
        $entity->setLastName('Prado');
        $entity->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuvnD8Z4Y8HdRYoidxmHLl7G_u8551SRmPjlEY_Hnz-YEuU-OF');
        $entity->setEmail('jlogistica@gmail.com');
        $entity->setIsActive(true);
        $entity->setProfile($profileJefeLogistica);
        $manager->persist($entity);

        $entity = new User();
//        $entity->setClient($client1);
//        $entity->setCode('X5577');
        $entity->setDni('77776666');
        $entity->setPassword('123');
        $entity->setName('Juan');
        $entity->setLastName('Perez');
        $entity->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuvnD8Z4Y8HdRYoidxmHLl7G_u8551SRmPjlEY_Hnz-YEuU-OF');
        $entity->setEmail('ealmacen@gmail.com');
        $entity->setIsActive(true);
        $entity->setProfile($profileEncargadoAlmacen);
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}