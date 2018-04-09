<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Services\Tree\BuildInterface\TreeInterface;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository implements TreeInterface
{

    public function findAll($limit = null, $offset = null)
    {
        return $this->findBy(['isActive' => 1], ['idIncrement' => 'DESC'], $limit, $offset);
    }

    public function findAllParents()
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT parent
            FROM AppBundle:Category parent
            WHERE
            parent.isActive = :active AND
            parent.category IS NULL
            ORDER BY parent.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    public function findAllByParent($parent)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT child
            FROM AppBundle:Category child
            WHERE
            child.isActive = :active AND
            child.category = :parent
            ORDER BY child.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('parent', $parent);

        return $query->getResult();
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT category
            FROM AppBundle:Category category
            WHERE
            category.idIncrement = :id AND
            category.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findAllObjects()
    {
        return $this->createQueryBuilder('a')
            ->where('a.isActive = :active')
            ->orderBy('a.idIncrement', 'DESC')
            ->setParameter('active', true)
            ;
    }
}

