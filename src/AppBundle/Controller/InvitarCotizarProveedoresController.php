<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Requerimiento;
use AppBundle\Entity\Product;
use AppBundle\Entity\Quote;
use AppBundle\Entity\Quotation;
use AppBundle\Entity\Proveedor;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;
use Symfony\Component\HttpFoundation\Session\Session;

class InvitarCotizarProveedoresController extends BaseController
{

    public function pasarComprasAction(Request $request)
    {

        $fields = $request->get('fields');
        $requerimientoId = $request->get('requerimiento_id');
        $requerimiento = $this->em()->getRepository(Requerimiento::class)->find($requerimientoId);


        /**
         * VALIDA SI ES EMPTY
         */
        $isEmpty = false;
        foreach ($fields as $key => $value){
            if($value['name'] == 'checkbox-pasar-compras'){
                $isEmpty = true;
            }
        }
        /**
         * VALIDA SI ES EMPTY
         */

        if(!$isEmpty){
            return $this->json([
                'status' => false,
                'msg' => 'Pasar a Compra:: Tiene que seleccionar un producto',
            ]);
        }



        /**
         * DELETE
         */
        foreach ($fields as $key => $value){

            if($value['name'] == 'checkbox-pasar-compras'){

                $productId = $value['value'];
                $quotes = $this->em()->getRepository(Quote::class)->findByRequerimientoProduct($requerimientoId, $productId);

                foreach ($quotes as $key => $quote){
                    $this->remove($quote);
                }
            }
        }
        /**
         * DELETE
         */


        /**
         * INSERT
         */
        foreach ($fields as $key => $value){

            if($value['name'] == 'checkbox-pasar-compras'){

                $productId = $value['value'];
                $product = $this->em()->getRepository(Product::class)->find($productId);

                $quote = new Quote();
                $quote->setRequerimiento($requerimiento);
                $quote->setProduct($product);
                $this->persist($quote);
            }
        }
        /**
         * INSERT
         */

        return $this->json([
            'status' => true
        ]);
    }

    public function indexAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $isEmpty = false;
        $entities = $this->em()->getRepository(Quote::class)->findAll();

        $productsArray = [];
        foreach ($entities as $key => $entity){
            $productId = $entity->getProduct()->getIdIncrement();
            $requerimientoId = $entity->getRequerimiento()->getIdIncrement();

            $products = $this->em()->getRepository(RequerimientoHasProduct::class)->findAllByRequerimientoCotizar($requerimientoId, $productId);
            $productsArray[] = $this->getSerializeDecode($products, 'requerimiento_has_product');
        }

        if($request->isMethod('POST')){

            $isEmpty = true;
            $quote = $request->get('quote');

            if(!empty($quote)){

                $this->get('session')->set('quote', $quote);

                $url = $this->generateUrl('app_invitar_cotizar_proveedores_generar_cotizacion');
                return $this->redirect($url);

            }
        }

        return $this->render(
            'AppBundle:InvitarCotizarProveedores:index.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'productsArray' => $productsArray,
                'isEmpty' => $isEmpty,
            ]
        );
    }

    public function generarCotizacionAction(Request $request)
    {

        $quotes = $this->get('session')->get('quote');

        if(empty($quotes)){
            $url = $this->generateUrl('app_invitar_cotizar_proveedores_index');
            return $this->redirect($url);
        }

        $quoteArray = [];
        foreach ($quotes as $key => $quote){

            $quote = explode("#", $quote);
            $requerimientoId = $quote[0];
            $productId = $quote[1];

            $quoteArray[$requerimientoId][] = $productId;
        }

        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $isEmpty = false;

        $productsArray = [];
        foreach ($quoteArray as $requerimientoId => $productsId){
            foreach ($productsId as $key => $productId){
                $products = $this->em()->getRepository(RequerimientoHasProduct::class)->findAllByRequerimientoCotizar($requerimientoId, $productId);

                if(empty($products)){
                    continue;
                }

                $productsArray[] = $this->getSerializeDecode($products, 'requerimiento_has_product');
            }
        }

        if($request->isMethod('POST')){

            $quotation = $request->get('quotation');

            $precioUnitario = $quotation['precio_unitario'];
            $requerimientoArray = $quotation['requerimiento'];
            $productArray = $quotation['product'];
            $cantidadPedidaArray = $quotation['cantidad_pedida'];

            foreach ($quotation['id'] as $key => $id){

                $obj = new Quotation();

                $proveedor = $this->em()->getRepository(Proveedor::class)->find($quotation['proveedor']);
                $obj->setProveedor($proveedor);
                $obj->setFormaPago($quotation['forma_pago']);
                $obj->setMontoTotal($quotation['monto_total']);
                $obj->setPrecioUnitario($precioUnitario[$key]);
                $obj->setEstado(Quotation::ESTADO_APROBADO);

                /**
                 * REQUERIMIENTO
                 */
                foreach ($cantidadPedidaArray as $key1 => $cantidadPedida){
                    $cantidadPedida = explode("#", $cantidadPedida);

                    if($cantidadPedida[0] == $id){
                        $obj->setCantidadPedida($cantidadPedida[1]);
                    }
                }

                /**
                 * REQUERIMIENTO
                 */
                foreach ($requerimientoArray as $key1 => $requerimiento){
                    $requerimiento = explode("#", $requerimiento);

                    if($requerimiento[0] == $id){
                        $obj->setRequerimientoId($requerimiento[1]);
                    }
                }

                /**
                 * PRODUCT
                 */
                foreach ($productArray as $key1 => $product){
                    $product = explode("#", $product);

                    if($product[0] == $id){
                        $obj->setProductId($product[1]);
                    }
                }

                $this->persist($obj);
            }

            $url = $this->generateUrl('app_quotation_lista_cotizacion');
            return $this->redirect($url);
        }

        $proveedor = $this->em()->getRepository(Proveedor::class)->findAll();
        $proveedor = $this->getSerializeDecode($proveedor, 'proveedor');

        return $this->render(
            'AppBundle:InvitarCotizarProveedores:generarCotizacion.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'productsArray' => $productsArray,
                'isEmpty' => $isEmpty,
                'proveedor' => $proveedor,
            ]
        );
    }


}
