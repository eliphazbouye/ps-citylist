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

class CityListRepository extends EntityRepository
{
    public function getCitiesInformation()
    {
        return $this->createQueryBuilder('c')
        ->addSelect('c')
        ->andWhere('c.active = 1')
        ->getQuery()->getResult();
    }
}