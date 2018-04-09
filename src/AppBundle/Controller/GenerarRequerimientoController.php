<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Requerimiento;
use AppBundle\Entity\Product;
use AppBundle\Entity\RequerimientoHasProduct;
use AppBundle\Form\RequerimientoType;

class GenerarRequerimientoController extends BaseController
{


    public function createAction(Request $request)
    {

        $crud = $this->get('app.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $entity = new Requerimiento();

//        if (!$this->isXmlHttpRequest($request) && !is_object($entity)) {
//            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
//        }

        $form = $this->createForm(RequerimientoType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->persist($entity);


            /**
             * RequerimientoHasProduct
             */
            $addProduct = $request->get('add-product');
            $ids = isset($addProduct['id']) ? $addProduct['id'] : [];
            $stocks = isset($addProduct['stock']) ? $addProduct['stock'] : [];

            foreach ($ids as $key => $id){

                $stock = isset($stocks[$key]) ? $stocks[$key] : 0;
                $product = $this->em()->getRepository(Product::class)->find($id);

                $requerimientoHasProduct = new RequerimientoHasProduct();
                $requerimientoHasProduct->setRequerimiento($entity);
                $requerimientoHasProduct->setProduct($product);
                $requerimientoHasProduct->setStock($stock);
                $this->persist($requerimientoHasProduct);
            }
            /**
             * RequerimientoHasProduct
             */

            $this->flashSuccess("Creado con exito!");

            $url = $this->generateUrl('app_despacho_almacen_index');
            return $this->redirect($url);

        }


        $product = $this->em()->getRepository(Product::class)->findAll();
        $product = $this->getSerializeDecode($product, 'product');

        return $this->render(
            'AppBundle:GenerarRequerimiento:create.html.twig',
            [
                'crud' => $crudMapper->getDefaults(),
                'formEntity' => $form->createView(),
                'product' => $product,
            ]
        );
    }

    /*

    /**
     * @Route("/", name="homepage")

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    */
}
