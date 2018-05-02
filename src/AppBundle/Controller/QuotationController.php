<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Quotation;
use AppBundle\Entity\QuotationMain;
use AppBundle\Entity\Product;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;

class QuotationController extends BaseController
{

    public function detalleCotizacionAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $id = $request->get('id');

        $quotationMain = $this->em()->getRepository(QuotationMain::class)->findAllHas($id);

        $quotationArray = [];
        foreach ($quotationMain as $key => $quotation){
            $entity = $this->em()->getRepository(Quotation::class)->find($quotation['quotation_id']);
            $quotationArray[] = $this->getSerializeDecode($entity, 'quotation');
        }

//        if(!$entity){
//            $url = $this->generateUrl('app_generar_requerimiento_create');
//            return $this->redirect($url);
//        }

        if($request->isMethod('POST')) {


            /*
           Array
            (
                [requerimiento] => Array
                    (
                        [0] => 3
                        [1] => 3
                        [2] => 3
                        [3] => 3
                        [4] => 2
                    )

                [product] => Array
                    (
                        [0] => 8#8
                        [1] => 9#7
                        [2] => 10#6
                        [3] => 11#5
                        [4] => 12#9
                    )

                [id] => Array
                    (
                        [0] => 8
                        [1] => 9
                        [2] => 10
                        [3] => 11
                        [4] => 12
                    )

                [cantidad_pedida] => Array
                    (
                        [0] => 8
                        [1] => 7
                        [2] => 6
                        [3] => 5
                        [4] => 7
                    )

            )
             */

            $quotation = $request->get('quotation');
            $ids = $quotation['id'];
            $cantidadPedida = $quotation['cantidad_pedida'];
            $products = $quotation['product'];
            

            $obj = $this->em()->getRepository(QuotationMain::class)->find($id);
            $obj->setEstado(QuotationMain::ESTADO_COMPLETADO);
            $this->persist($obj);



            /**
             * Quotation
             */
            foreach ($ids as $key => $id){

                /**
                 * Product
                 */
                foreach ($products as $key3 => $product){
                    $productArray = explode("#", $product);
                    $idX = $productArray[0];
                    $productId = $productArray[1];

                    if($idX == $id){
                        $product = $this->em()->getRepository(Product::class)->find($productId);

                        $stockActual = !empty($product->getStock()) ? $product->getStock() : 0;

                        $stock = $stockActual + $cantidadPedida[$key];
                        $product->setStock($stock);
                        $this->persist($product);
                    }
                }
            }

            $url = $this->generateUrl('app_quotation_main_lista_ordenes_compra');
            return $this->redirect($url);

        }

        $firstArray = isset($quotationArray[0]) ? $quotationArray[0] : null;

        return $this->render(
            'AppBundle:Quotation:detalleCotizacion.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $quotationArray,
                'firstArray' => $firstArray,
                'id' => $id,
            ]
        );
    }

    public function detalleOrdenesCompraAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();


        $id = $request->get('id');

        $quotationMain = $this->em()->getRepository(QuotationMain::class)->findAllHas($id);

        $quotationArray = [];
        foreach ($quotationMain as $key => $quotation){
            $entity = $this->em()->getRepository(Quotation::class)->find($quotation['quotation_id']);
            $quotationArray[] = $this->getSerializeDecode($entity, 'quotation');
        }

//        if(!$entity){
//            $url = $this->generateUrl('app_generar_requerimiento_create');
//            return $this->redirect($url);
//        }

        $firstArray = isset($quotationArray[0]) ? $quotationArray[0] : null;

        return $this->render(
            'AppBundle:Quotation:detalleOrdenesCompra.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $quotationArray,
                'id' => $id,
                'firstArray' => $firstArray,
            ]
        );
    }

}
