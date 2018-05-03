<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Requerimiento;
use AppBundle\Entity\Product;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;

class DespachoAlmacenController extends BaseController
{

    public function indexAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $entity = $this->em()->getRepository(Requerimiento::class)->findAll();
        $entity = $this->getSerializeDecode($entity, 'requerimiento');

//        if(!$entity){
//            $url = $this->generateUrl('app_despacho_almacen_index');
//            return $this->redirect($url);
//        }

        return $this->render(
            'AppBundle:DespachoAlmacen:index.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $entity,
            ]
        );
    }

    public function viewAction(Request $request)
    {

        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $id = $request->get('id');
        $entity = $this->em()->getRepository(Requerimiento::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('DESPACHO: Unable to find  entity.');
        }

        $form = $this->createForm(RequerimientoType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->persist($entity);

            $this->flashSuccess("Creado con exito!");

            $url = $this->generateUrl('app_generar_requerimiento_create');
            return $this->redirect($url);

        }

        $products = $this->em()->getRepository(RequerimientoHasProduct::class)->findAllByRequerimiento($id);
        $products = $this->getSerializeDecode($products, 'requerimiento_has_product');

        return $this->render(
            'AppBundle:DespachoAlmacen:view.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $entity,
                'id' => $id,
                'formEntity' => $form->createView(),
                'products' => $products,
            ]
        );
    }

    public function viewCreateAction(Request $request)
    {

        $id = $request->get('id');
        $fields = $request->get('fields');

        foreach ($fields as $key => $value){

            if($value['name'] == 'quantity'){
                $number = explode("#", $value['value']);

                $productId = $number[0];
                $cantidadPedida = $number[1];
                $stock = $number[2];

                if($cantidadPedida > $stock){
                    return $this->json([
                        'id' => $id,
                        'status' => false,
                        'msg' => "No hay stock (".$stock.") del producto con id (".$productId.") por la cantidad pedida (".$cantidadPedida.").",
                    ]);
                }
            }
        }

        $entity = $this->em()->getRepository(Requerimiento::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('DESPACHO: Unable to find  entity.');
        }

        $form = $this->createForm(RequerimientoType::class, $entity);
        $form->handleRequest($request);

        $entity->setEstado(Requerimiento::ESTADO_COMPLETADO);
        $this->persist($entity);


        /**
         * PRODUCT
         */
        $fields = $request->get('fields');

        foreach ($fields as $key => $value){

            if($value['name'] == 'quantity'){
                $number = explode("#", $value['value']);

                $productId = $number[0];
                $cantidadPedida = $number[1];
                $stock = $number[2];

                $product = $this->em()->getRepository(Product::class)->find($productId);
//                $stockActual = $product->getStock();
                $stockNuevo = $product->getStock() - $cantidadPedida;
                $product->setStock($stockNuevo);
                $this->persist($product);
            }
        }
        /**
         * PRODUCT
         */


        return $this->json([
            'id' => $id,
            'status' => true,
        ]);
    }



}
