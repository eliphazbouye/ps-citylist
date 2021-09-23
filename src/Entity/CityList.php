<?php

namespace Citylist\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class CityList
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id_citylist", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_country", type="integer")
     */
    private $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name", type="string", length=64)
     */
    private $cityName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     *
     * @return CityList
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param string $cityName
     *
     * @return CityList
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

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
     * @return CityList
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id_country' => $this->getCountryId(),
            'id_city_list' => $this->getId(),
            'city_name' => $this->getCityName(),
            'active' => $this->getActive(),
        ];
    }
}