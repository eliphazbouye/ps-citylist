<?php

namespace Tntrunkscity\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Tntrunkscity\Form\CityType;
use Tntrunkscity\Entity\CityList;

class TntrunkscityController extends FrameworkBundleAdminController
{
    public function demoAction()
    {
        return new Response('Hello Tntrunks Yeah');
        // return $this->render('@Modules/your-module/templates/admin/demo.html.twig');
    }

    public function createAction(Request $request)
    {
        $form = $this->createForm(CityType::class);

        $form->handleRequest($request);

        //Logic of form submitting
        if (
            $form->isSubmitted() &&
            $form->isValid()
        ) {
            //Logic for store the data in DB
            $em = $this->getDoctrine()->getManager();

            //Prepare the objet will be saved to the DB
            $cityList = new CityList();

            $cityList->setCountryId($form->get('id_country')->getData());
            $cityList->setCityName($form->get('city_name')->getData());
            $cityList->setActive($form->get('active')->getData());

            //persiste the data on database
            $em->persist($cityList);
            $em->flush();
        }


        return $this->render('@Modules/tntrunkscity/templates/admin/create.html.twig', array(
            'form' => $form->createView()
        ));
    }
}