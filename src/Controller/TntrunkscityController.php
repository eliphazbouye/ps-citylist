<?php

namespace Tntrunkscity\Controller;

use GuzzleHttp\Subscriber\Redirect;
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

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $data = $em->getRepository(CityList::class)->findAll();

        return $this->render('@Modules/tntrunkscity/templates/admin/list.html.twig', array(
            'data' => $data
        ));
    }

    public function deleteAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $city = $em->getRepository(CityList::class)->findOneBy(array('id' => $id));

        if ($city) {
            $em->remove($city);
        }
        $em->flush();

        return $this->redirectToRoute('city_list', array(), 301);
    }
}