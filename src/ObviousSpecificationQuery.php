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

class ObviousSpecificationQuery implements SpecificationQuery
{
    /**
     * @var string
     */
    private $entity = '';

    /**
     * @var Specification
     */
    private $spec = '';

    /**
     * @var ResultModifier|null
     */
    private $modifier = '';

    /**
     * @param string              $entity
     * @param Specification       $spec
     * @param ResultModifier|null $modifier
     */
    public function __construct($entity, Specification $spec, ResultModifier $modifier = null)
    {
        $this->entity = $entity;
        $this->spec = $spec;
        $this->modifier = $modifier;
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return Specification
     */
    public function getSpec()
    {
        return $this->spec;
    }

    /**
     * @return ResultModifier|null
     */
    public function getModifier()
    {
        return $this->modifier;
    }
}
