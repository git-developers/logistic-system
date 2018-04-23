<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;

class Load_5_ProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new Product();
        $entity->setCode('1000000000');
        $entity->setName('MIYAKO RAMUNE ORANGE 6.76floz');
        $entity->setDescription('description');
        $entity->setStock(15);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000001');
        $entity->setName('MIYAKO RAMUNE STRAWBERRY 6.76 FL.oz');
        $entity->setDescription('description');
        $entity->setStock(8);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000002');
        $entity->setName('MIYAKO RAMUNE PEACH 6.76floz');
        $entity->setDescription('description');
        $entity->setStock(11);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000003');
        $entity->setName('UCC MELON CREAM SODA CAN');
        $entity->setDescription('description');
        $entity->setStock(77);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000004');
        $entity->setName('UCC MILK COFFEE CAN');
        $entity->setDescription('description');
        $entity->setStock(20);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000005');
        $entity->setName('MIYAKO RAMUNE 6.76 FL.oz');
        $entity->setDescription('description');
        $entity->setStock(25);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000006');
        $entity->setName('MIYAKO RAMUNE LYCHEE 6.76floz');
        $entity->setDescription('description');
        $entity->setStock(40);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000007');
        $entity->setName('UCC OOLONG TEA CAN');
        $entity->setDescription('description');
        $entity->setStock(88);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000008');
        $entity->setName('UCC GREEN TEA 11.1oz');
        $entity->setDescription('description');
        $entity->setStock(66);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('1000000009');
        $entity->setName('AYATAKA COCA COLA 17.5OZ. (525 ml.) 6898');
        $entity->setDescription('description');
        $entity->setStock(43);
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $manager->persist($entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}