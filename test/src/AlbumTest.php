<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlbumTest
 *
 * @author carschrotter
 */
use Album\Model\Album;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

class AlbumTest extends \PHPUnit_Framework_TestCase {

    protected $a;

    public function setUp() {
        $this->a = new Album();
    }

    /**
     * @expectedException Album\Model\AlbumException
     * @expectedExceptionMessage Not used
     */
    public function testSetInputFilter() {
        $if = $this->getMock(InputFilterInterface::class);
        $this->a->setInputFilter($if);
    }

    public function testGetInputFilter() {
        $if = $this->a->getInputFilter();

        $this->assertInstanceOf(InputFilter::class, $if);
        return $if;
    }

    /**
     * @depends testGetInputFilter
     */
    public function testInputFilterValid($if) {
        $this->assertEquals(3, $if->count());

        $this->assertTrue($if->has('title'));
        $this->assertTrue($if->has('artist'));
        $this->assertTrue($if->has('id'));
    }

}
