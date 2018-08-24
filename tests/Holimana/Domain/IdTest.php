<?php
/**
 * Created by PhpStorm.
 * User: vigarcia
 * Date: 24/08/18
 * Time: 12:51
 */

namespace Tests\Holimana\Domain;

use Holimana\Domain\IdFactory;
use PHPUnit\Framework\TestCase;

class IdTest extends TestCase
{
    private $Id;

    protected function setUp()
    {
        $this->Id = IdFactory::create();
    }

    /**
     * @test
     */
    public function tryToInstanceWithFixedValue()
    {
        $id = IdFactory::create('1');
        $this->assertSame('1', $id->id());
    }

    /**
     * @test
     */
    public function tryEqualsMethod()
    {
        $this->assertTrue($this->id()->equals($this->id()));
        $this->assertFalse($this->id()->equals(IdFactory::create()));
    }

    private function id()
    {
        return $this->Id;
    }
}
