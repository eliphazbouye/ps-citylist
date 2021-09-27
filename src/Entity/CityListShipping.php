<?php

use Citylist\Entity\CityList;
namespace Citylist\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class CityListShipping
{
    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="CityList")
     */
    private $cityList;

    /**
     * @var int
     *
     * @ORM\Column(name="id_zone", type="integer")
     */
    private $zoneId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;



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