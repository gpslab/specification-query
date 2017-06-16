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
use Happyr\DoctrineSpecification\Spec;

class SpecificationQueryHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|EntityManagerInterface
     */
    private $em;

    /**
     * @var SpecificationQueryHandler
     */
    private $handler;

    protected function setUp()
    {
        $this->em = $this->getMock(EntityManagerInterface::class);
        $this->handler = new SpecificationQueryHandler($this->em);
    }

    public function testHandle()
    {
        $entity = 'foo';
        $spec = Spec::andX();
        $modifier = Spec::cache(3600);
        $result = 'bar';

        /* @var $query \PHPUnit_Framework_MockObject_MockObject|SpecificationQuery */
        $query = $this->getMock(SpecificationQuery::class);
        $query
            ->expects($this->once())
            ->method('entity')
            ->will($this->returnValue($entity))
        ;
        $query
            ->expects($this->once())
            ->method('spec')
            ->will($this->returnValue($spec))
        ;
        $query
            ->expects($this->once())
            ->method('modifier')
            ->will($this->returnValue($modifier))
        ;

        /* @var $rep \PHPUnit_Framework_MockObject_MockObject|EntitySpecificationRepositoryInterface */
        $rep = $this->getMock(EntitySpecificationRepositoryInterface::class);
        $rep
            ->expects($this->once())
            ->method('match')
            ->with($spec, $modifier)
            ->will($this->returnValue($result))
        ;

        $this->em
            ->expects($this->once())
            ->method('getRepository')
            ->with($entity)
            ->will($this->returnValue($rep))
        ;

        $this->assertEquals($result, $this->handler->handleSpecification($query));
    }
}
