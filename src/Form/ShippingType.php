<?php

namespace Citylist\Form;

use Citylist\Entity\CityList;
use Citylist\Repository\CityListRepository;
use DbQuery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ShippingType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $zones = array();
        $getZone = \Zone::getZones();

        foreach ($getZone as $zone) {
            $zones[$zone['name']] = $zone['id_zone'];
        }

        return $builder
            ->add('cityList', EntityType::class, array(
                'class' => CityList::class,
                'query_builder' => function (CityListRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.cityName', 'ASC');
                },
                "choice_label" => "city_name",
                "required" => true,
                'mapped' => false 
            ))
            ->add('zoneId', ChoiceType::class, array(
                "label" => "Zone",
                "choices" => $zones
            ))
            ->add('active', CheckboxType::class, array(
                "label" => "Active",
                "required" => false
            ))
            ->add('save', SubmitType::class);
    }
}