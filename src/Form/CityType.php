<?php

namespace Tntrunkscity\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CityType extends AbstractType
{


    private function countryFormDb()
    {
        $sql = '
        SELECT * FROM `' . pSQL(_DB_PREFIX_) . 'country` WHERE `active` = 1
        ';

        return \Db::getInstance()->executeS($sql);
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $result = $this->countryFormDb();

        $citys = array();

        foreach ($result as $city) {
            $citys[\Country::getNameById(1, $city['id_country'])] = $city['id_country'];
        }

        return $builder
            ->add('cityName', TextType::class, array(
                "label" => "City name",
                "attr" => array(
                    "placeholder" => "The city name"
                )
            ))
            ->add('countryId', ChoiceType::class, array(
                "label" => "Choose country",
                "choices" => $citys
            ))
            ->add('active', CheckboxType::class, array(
                "label" => "Active",
                "required" => false
            ))
            ->add('save', SubmitType::class);
    }
}