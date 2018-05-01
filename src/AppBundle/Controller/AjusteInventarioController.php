<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Requerimiento;
use AppBundle\Entity\Product;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;

class AjusteInventarioController extends BaseController
{

    public function indexAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $entity = $this->em()->getRepository(Product::class)->findAll();
        $entity = $this->getSerializeDecode($entity, 'product');


//        echo '<pre> POLLO:: ';
//        print_r($entity);
//        exit;


//        if(!$entity){
//            $url = $this->generateUrl('app_despacho_almacen_index');
//            return $this->redirect($url);
//        }

        return $this->render(
            'AppBundle:AjusteInventario:index.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $entity,
            ]
        );
    }

    public function updateAction(Request $request)
    {

        $ids = $request->get('idx');
        $products = $request->get('product');

        foreach ($products as $key => $productNuevoStock){

            if((int) $productNuevoStock <= 0){
                continue;
            }

            $productId = $ids[$key];

            $entity = $this->em()->getRepository(Product::class)->find($productId);
            $entity->setStock($productNuevoStock);
            $this->persist($entity);
        }

        return $this->json([
            'status' => true,
            'msg' => 'xxxxxxxxxxx',
        ]);

    }


}
