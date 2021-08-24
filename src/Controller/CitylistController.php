<?php

namespace Citylist\Controller;

use Country;
use GuzzleHttp\Subscriber\Redirect;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Citylist\Form\CityType;
use Citylist\Entity\CityList;

class CitylistController extends FrameworkBundleAdminController
{
    public function demoAction()
    {
        return new Response('Hello Citylist Yeah');
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

            $cityList->setCountryId($form->get('countryId')->getData());
            $cityList->setCityName($form->get('cityName')->getData());
            $cityList->setActive($form->get('active')->getData());

            //persiste the data on database
            $em->persist($cityList);
            $em->flush();

            $this->addFlash(
                'notice',
                'City saved!'
            );

            return $this->redirectToRoute('city_list', array(), 301);
        }


        return $this->render('@Modules/citylist/templates/admin/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function listAction()
    {
        $sql = '
            SELECT `id_country` FROM `' . pSQL(_DB_PREFIX_) . 'city_list`
        ';
        $result = \Db::getInstance()->executeS($sql);

        $em = $this->getDoctrine()->getManager();

        $data = $em->getRepository(CityList::class)->findAll();

        $table_city = array();
        foreach ($result as $key => $value) {
            $table_city[$value['id_country']] = \Country::getNameById(1, $value['id_country']);
        }

        return $this->render('@Modules/citylist/templates/admin/list.html.twig', array(
            'data' => $data,
            'table_city' => $table_city
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

        $this->addFlash(
            'notice',
            'City deleted!'
        );

        return $this->redirectToRoute('city_list', array(), 301);
    }

    public function updateAction(int $id, Request $request)
    {

        if ($id === null) {
            return null;
        }

        $em = $this->getDoctrine()->getManager();

        $cityForUpdate = $em->getRepository(CityList::class)
            ->find($id);

        $form = $this->createForm(CityType::class, $cityForUpdate);
        $form->handleRequest($request);

        if (
            $form->isSubmitted() &&
            $form->isValid()
        ) {

            $cityForUpdate->setCountryId($form->get('countryId')->getData());
            $cityForUpdate->setCityName($form->get('cityName')->getData());
            $cityForUpdate->setActive($form->get('active')->getData());

            $em->flush();


            $this->addFlash(
                'notice',
                'City updated!'
            );
        }
        return $this->render('@Modules/citylist/templates/admin/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}