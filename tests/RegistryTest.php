<?php

use dbeurive\Registry\Registry;



class RegistryTest extends PHPUnit_Framework_TestCase
{

    public function setUp() {
        Registry::reset();
        Registry::register('EntryA', 'A', false);
        Registry::register('EntryB', 'B', true);
    }

    public function testRegister() {

        $this->expectException(\Exception::class);
        Registry::register('EntryA', 'AA');
        Registry::register('EntryB', 'BB');
    }

    public function testSetOk() {

        Registry::set('EntryA', 12);
        $this->assertEquals(12, Registry::get('EntryA'));
    }

    public function testSetKo() {

        // The value of the entry "entryB" is a constant.
        $this->expectException(\Exception::class);
        Registry::set('EntryB', 'BB');
    }

    public function testGet() {
        $this->assertEquals('A', Registry::get('EntryA'));
        $this->assertEquals('B', Registry::get('EntryB'));
    }

    public function testIsRegistered() {
        $this->assertTrue(Registry::isRegistered('EntryA'));
        $this->assertTrue(Registry::isRegistered('EntryB'));
        $this->assertFalse(Registry::isRegistered('toto'));
    }

    public function testIsConstant() {
        $this->assertTrue(Registry::isConstant('EntryB'));
        $this->assertFalse(Registry::isConstant('EntryA'));
    }
}