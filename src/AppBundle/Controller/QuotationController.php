<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Quotation;
use AppBundle\Entity\Product;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;

class QuotationController extends BaseController
{

    public function listaCotizacionAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $entity = $this->em()->getRepository(Quotation::class)->findAllByEstado(Quotation::ESTADO_APROBADO);
        $entity = $this->getSerializeDecode($entity, 'quotation');

//        if(!$entity){
//            $url = $this->generateUrl('app_generar_requerimiento_create');
//            return $this->redirect($url);
//        }

        if($request->isMethod('POST')) {

            $quotation = $request->get('quotation');
            $ids = $quotation['id'];
            $cantidadPedida = $quotation['cantidad_pedida'];
            $products = $quotation['product'];


            /**
             * Quotation
             */
            foreach ($ids as $key => $id){

                $obj = $this->em()->getRepository(Quotation::class)->find($id);
                $obj->setEstado(Quotation::ESTADO_COMPLETADO);
                $this->persist($obj);


                /**
                 * Product
                 */
                foreach ($products as $key3 => $product){
                    $productArray = explode("#", $product);
                    $idX = $productArray[0];
                    $productId = $productArray[1];

                    if($idX = $id){
                        $product = $this->em()->getRepository(Product::class)->find($productId);
                        $stock = $product->getStock() + $cantidadPedida[$key];
                        $product->setStock($stock);
                        $this->persist($product);
                    }
                }
            }




            $url = $this->generateUrl('app_quotation_lista_ordenes_compra');
            return $this->redirect($url);

        }

        return $this->render(
            'AppBundle:Quotation:listaCotizacion.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $entity,
            ]
        );
    }

    public function listaOrdenesCompraAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $entity = $this->em()->getRepository(Quotation::class)->findAllByEstado(Quotation::ESTADO_COMPLETADO);
        $entity = $this->getSerializeDecode($entity, 'quotation');

//        if(!$entity){
//            $url = $this->generateUrl('app_generar_requerimiento_create');
//            return $this->redirect($url);
//        }

        return $this->render(
            'AppBundle:Quotation:listaOrdenesCompra.html.twig',
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

            $url = $this->generateUrl('app_generar_requerimiento_index');
            return $this->redirect($url);

        }

        $products = $this->em()->getRepository(RequerimientoHasProduct::class)->findAllByRequerimiento($id);
        $products = $this->getSerializeDecode($products, 'product');


        return $this->render(
            'AppBundle:RecepcionMercaderia:view.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $entity,
                'formEntity' => $form->createView(),
                'products' => $products,
            ]
        );
    }

}
