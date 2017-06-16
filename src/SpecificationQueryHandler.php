<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Query\Specification;

use Doctrine\ORM\EntityManagerInterface;
use Happyr\DoctrineSpecification\EntitySpecificationRepositoryInterface;

class SpecificationQueryHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param SpecificationQuery $query
     *
     * @return mixed
     */
    public function handleSpecification(SpecificationQuery $query)
    {
        /* @var $rep EntitySpecificationRepositoryInterface */
        $rep = $this->em->getRepository($query->entity());

        return $rep->match($query->spec(), $query->modifier());
    }
}
