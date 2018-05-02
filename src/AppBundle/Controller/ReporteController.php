<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Requerimiento;
use AppBundle\Entity\Product;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;

class ReporteController extends BaseController
{

    public function indexAction(Request $request)
    {

//        if(!$entity){
//            $url = $this->generateUrl('app_despacho_almacen_index');
//            return $this->redirect($url);
//        }

        return $this->render(
            'AppBundle:Reporte:index.html.twig',
            [
                'entity' => null,
            ]
        );
    }

    public function updateAction(Request $request)
    {

    }


}
