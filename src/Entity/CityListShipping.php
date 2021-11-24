<?php

namespace Citylist\Entity;
use Citylist\Entity\CityList;
use Doctrine\ORM\Mapping as ORM;


use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Unique;



/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Citylist\Repository\CityListShippingRepository")
 */
class CityListShipping
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_city_list_shipping", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="CityList")
     * @ORM\JoinColumn(name="id_citylist", referencedColumnName="id_citylist", nullable=false)
     * Unique()
     */
    private $cityList;

    /**
     * @var int
     *
     * @ORM\Column(name="id_zone", type="integer", unique=true)
     */
    private $zoneId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
        

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return cityList
     */
    public function getCityList()
    {
        return $this->cityList;
    }

    /**
     * @param void cityList
     *
     * @return CityListShipping
     */
    public function setCityList($cityList)
    {
        $this->cityList = $cityList;

        return $this;
    }


    /**
     * @return int
     */
    public function getZoneId()
    {
        return $this->zoneId;
    }

    /**
     * @param int $zoneId
     *
     * @return CityListShipping
     */
    public function setZoneId($zoneId)
    {
        $this->zoneId = $zoneId;

        return $this;
    }


    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     *
     * @return CityListShipping
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }


}