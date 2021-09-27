<?php

namespace Citylist\Controller;

use Citylist\Entity\CityListShipping;
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


        if(
            $form->isSubmitted() &&
            $form->isValid()
        ) {
            $em = $this->getDoctrine()->getManager();

            $cityListShipping = new CityListShipping();

            $cityListShipping->setCityList($form->get('cityList')->getData());
            $cityListShipping->setZoneId($form->get('zoneId')->getData());
            $cityListShipping->setActive($form->get('active')->getData());

            $em->persist($cityListShipping);
            $em->flush();

            $this->addFlash(
                'notice',
                'City Shipping created successfully'
            );

            // return $this->redirectToRoute('city_shipping_list', [], 301);
        }


        return $this->render('@Modules/citylist/views/templates/admin/shipping/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}