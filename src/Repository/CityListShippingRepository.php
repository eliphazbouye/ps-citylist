<?php
/**
 * 2007-2020 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0).
 * It is also available through the world-wide-web at this URL: https://opensource.org/licenses/AFL-3.0
 */

declare(strict_types=1);

namespace Citylist\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class CityListShippingRepository extends EntityRepository
{
    public function getShippings()
    {
        $cl = $this->createQueryBuilder('cls')
        ->addSelect('cls')
        ->andWhere('cls.active = 1');

        $cities = $cl->getQuery()->getResult();

        return $cities;
    }

    public function findById($id)
    {   
        $em = $this->getEntityManager();
        return $em->createQuery('SELECT cls FROM Citylist\Entity\CityListShipping cls WHERE cls.id = :id')
        ->setParameter('id', $id)
        ->getResult();
    }
}