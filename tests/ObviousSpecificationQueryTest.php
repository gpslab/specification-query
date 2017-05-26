<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Query\Specification;

use Happyr\DoctrineSpecification\Spec;

class ObviousSpecificationQueryTest extends \PHPUnit_Framework_TestCase
{
    public function testHasModifier()
    {
        $entity = 'foo';
        $spec = Spec::andX();
        $modifier = Spec::cache(3600);

        $query = new ObviousSpecificationQuery($entity, $spec, $modifier);

        $this->assertEquals($entity, $query->entity());
        $this->assertEquals($spec, $query->spec());
        $this->assertEquals($modifier, $query->modifier());
    }

    public function testNoModifier()
    {
        $entity = 'foo';
        $spec = Spec::andX();

        $query = new ObviousSpecificationQuery($entity, $spec);

        $this->assertEquals($entity, $query->entity());
        $this->assertEquals($spec, $query->spec());
        $this->assertNull($query->modifier());
    }
}
