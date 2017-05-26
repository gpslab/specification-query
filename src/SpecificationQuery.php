<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Query\Specification;

use Happyr\DoctrineSpecification\Result\ResultModifier;
use Happyr\DoctrineSpecification\Specification\Specification;
use GpsLab\Component\Query\Query;

interface SpecificationQuery extends Query
{
    /**
     * @return string
     */
    public function entity();

    /**
     * @return Specification
     */
    public function spec();

    /**
     * @return ResultModifier|null
     */
    public function modifier();
}
