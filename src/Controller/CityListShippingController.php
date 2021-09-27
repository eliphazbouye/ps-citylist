<?php

namespace Citylist\Controller;

use Citylist\Form\ShippingType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CityListShippingController extends FrameworkBundleAdminController
{
    public function demoAction()
    {
        return new Response('Hello Citylist Yeah');
        // return $this->render('@Modules/your-module/views/templates/admin/demo.html.twig');
    }

    public function createAction(Request $request)
    {
        $form = $this->createForm(ShippingType::class);

        $form->handleRequest($request);

        return $this->render('@Modules/citylist/views/templates/admin/shipping/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}