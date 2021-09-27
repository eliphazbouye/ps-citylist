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
            // return die(dump($em->flush()));


            $this->addFlash(
                'notice',
                'City Shipping created successfully'
            );

            return $this->redirectToRoute('city_shipping_list', [], 301);
        }


        return $this->render('@Modules/citylist/views/templates/admin/shipping/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $data = $em->getRepository(CityListShipping::class)->findAll();


        return $this->render('@Modules/citylist/views/templates/admin/shipping/list.html.twig',[
            'data' => $data
        ]);
    }


    public function updateAction(int $id, Request $request)
    {
        if($id == null){
            return null;
        }

        $em = $this->getDoctrine()->getManager();
        $cityListShippingForUpdate = $em->getRepository(CityListShipping::class)
        ->find($id);


        $form = $this->createForm(ShippingType::class,$cityListShippingForUpdate);
        $form->handleRequest($request);


        if(
            $form->isSubmitted() && 
            $form->isValid()
        ) {
            $cityListShippingForUpdate->setCityList($form->get('cityList')->getData());
            $cityListShippingForUpdate->setZoneId($form->get('zoneId')->getData());
            $cityListShippingForUpdate->setActive($form->get('active')->getData());
            

            $em->flush();

            $this->addFlash(
                'notice',
                'City shipping updated successfull'
            );

            // return $this->redirectToRoute('city_shipping_list', [], 301);
        
        }

        return $this->render('@Modules/citylist/views/templates/admin/shipping/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    public function deleteAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $cityListShipping = $em->getRepository(CityListShipping::class)->findOneBy(array('cityList' => $id));

        if($cityListShipping) {
            $em->remove($cityListShipping);
        }

        $em->flush();

        $this->addFlash(
            'notice',
            'City shipping deleted successfully'
        );

        return $this->redirectToRoute('city_shipping_list', [], 301);
    }

}