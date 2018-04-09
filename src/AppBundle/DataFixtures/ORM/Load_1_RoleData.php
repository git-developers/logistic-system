<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Role;

class Load_1_RoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        /**
         * ROLE
         */
        $entity = new Role();
        $entity->setName('logistic_system');
        $entity->setSlug(Role::ROLE_JEFE_TIENDA);
        $entity->setGroupRol('logistic_system');
        $entity->setGroupRolTag('group-logistic-system');
        $manager->persist($entity);
        $this->addReference('role-jefe-tienda', $entity);

        $entity = new Role();
        $entity->setName('logistic_system');
        $entity->setSlug(Role::ROLE_JEFE_LOGISTICA);
        $entity->setGroupRol('logistic_system');
        $entity->setGroupRolTag('group-logistic-system');
        $manager->persist($entity);
        $this->addReference('role-jefe-logistico', $entity);


        $entity = new Role();
        $entity->setName('logistic_system');
        $entity->setSlug(Role::ROLE_ENCARGADO_ALMACEN);
        $entity->setGroupRol('logistic_system');
        $entity->setGroupRolTag('group-logistic-system');
        $manager->persist($entity);
        $this->addReference('role-encargado-almacen', $entity);



        /**
         * ROLE_ADMIN
         */
        $entity = new Role();
        $entity->setName('backend');
        $entity->setSlug('ROLE_ADMIN');
        $entity->setGroupRol('backend');
        $entity->setGroupRolTag('group-backend');
        $manager->persist($entity);
        $this->addReference('role-backend', $entity);


        /**
         * USER
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_USER_CREATE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-create-user', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_USER_EDIT');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-edit-user', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_USER_DELETE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-delete-user', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_USER_VIEW');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-view-user', $entity);

        $entity = new Role();
        $entity->setName('changepassword');
        $entity->setSlug('ROLE_USER_CHANGEPASSWORD');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-changepassword-user', $entity);


        /**
         * ACLROLE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_ACLROLE_CREATE');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-create-aclrole', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_ACLROLE_EDIT');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-edit-aclrole', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_ACLROLE_DELETE');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-delete-aclrole', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ACLROLE_VIEW');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-view-aclrole', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);



        /**
         * ACLPROFILE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_ACLPROFILE_CREATE');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-create-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_ACLPROFILE_EDIT');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-edit-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_ACLPROFILE_DELETE');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-delete-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ACLPROFILE_VIEW');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-view-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}