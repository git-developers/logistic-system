<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Proveedor;

class Load_6_ProveedorData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new Proveedor();
        $entity->setRuc('10004169897');
        $entity->setRazonSocial('VACCARO TAPIA MIRIAN CONCEPCION');
        $manager->persist($entity);

        $entity = new Proveedor();
        $entity->setRuc('10011340968');
        $entity->setRazonSocial('SANTA CRUZ SANCHEZ JAIME');
        $manager->persist($entity);

        $entity = new Proveedor();
        $entity->setRuc('10027894955');
        $entity->setRazonSocial('DIONICIO GUTIERREZ VELASCO');
        $manager->persist($entity);

        $entity = new Proveedor();
        $entity->setRuc('10060553985');
        $entity->setRazonSocial('AGUIRRE SUAREZ, FELICITAS');
        $manager->persist($entity);

        $entity = new Proveedor();
        $entity->setRuc('10061204429');
        $entity->setRazonSocial('YANAHURA MORISHITA JUAN A.');
        $manager->persist($entity);

        $entity = new Proveedor();
        $entity->setRuc('10061304415');
        $entity->setRazonSocial('ANA MARIA COLLAS BERRU');
        $manager->persist($entity);

        $entity = new Proveedor();
        $entity->setRuc('10061760704');
        $entity->setRazonSocial('TRUJILLO MIRANDA REINALDO');
        $manager->persist($entity);

        $entity = new Proveedor();
        $entity->setRuc('10062264395');
        $entity->setRazonSocial('MOLINA ALVINO RAUL FORTUNATO');
        $manager->persist($entity);

        $entity = new Proveedor();
        $entity->setRuc('10062379478');
        $entity->setRazonSocial('ARAKAKI OSHIRO, JUANA');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 6;
    }
}