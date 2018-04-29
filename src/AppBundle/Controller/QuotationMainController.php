<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\QuotationMain;
use AppBundle\Entity\Product;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;

class QuotationMainController extends BaseController
{

    public function listaCotizacionAction(Request $request)
    {
        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $entity = $this->em()->getRepository(QuotationMain::class)->findAllByEstado(QuotationMain::ESTADO_APROBADO);
        $entity = $this->getSerializeDecode($entity, 'quotation_main');

//        if(!$entity){
//            $url = $this->generateUrl('app_generar_requerimiento_create');
//            return $this->redirect($url);
//        }

        if($request->isMethod('POST')) {

            $quotation = $request->get('quotation');
            $ids = $quotation['id'];
            $cantidadPedida = $quotation['cantidad_pedida'];
            $products = $quotation['product'];


            $url = $this->generateUrl('app_quotation_lista_ordenes_compra');
            return $this->redirect($url);

        }

        return $this->render(
            'AppBundle:QuotationMain:listaCotizacion.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'entity' => $entity,
            ]
        );
    }

}
