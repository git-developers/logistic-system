<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Requerimiento;
use AppBundle\Entity\Product;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;

class InvitarCotizarProveedoresController extends BaseController
{

    public function indexAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $entity = $this->em()->getRepository(RequerimientoHasProduct::class)->findAll();
        $entity = $this->getSerializeDecode($entity, 'requerimiento_has_product');

        return $this->render(
            'AppBundle:InvitarCotizarProveedores:index.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $entity,
            ]
        );
    }


}
