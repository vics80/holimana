<?php

namespace Tests\Holimana\Domain;

use Holimana\Domain\User\UserFactory;
use Holimana\Domain\Day\DayCollectionFactory;
use Holimana\Domain\User\UserIdFactory;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $dayCollection;
    private $userId;
    private $user;

    public function setUp()
    {
        $this->dayCollection = DayCollectionFactory::create();
        $this->userId = UserIdFactory::create();
        $this->user = UserFactory::create(
            $this->userId(),
            'Víctor',
            'Garcia',
            'victorvgm@gmail.com',
            'testpassword',
            $this->dayCollection()
        );
    }

    /**
     * @test
     */
    public function tryToInstance()
    {
        $this->assertTrue($this->userId()->equals($this->user()->id()));
        $this->assertSame('Víctor', $this->user()->firstname());
        $this->assertSame('Garcia', $this->user()->lastname());
        $this->assertSame('victorvgm@gmail.com', $this->user()->email());
        $this->assertSame('testpassword', $this->user()->password());
        $this->assertSame($this->dayCollection(), $this->user()->days());
    }

    public function tryToAddDays()
    {
//        $user = $this->getUser();
//        $user->setDays($user->days()->add);
    }

    private function makeUser(): User
    {
        return new User(
            '1',
            'Víctor',
            'Garcia',
            'vigarcia@leadtech.com',
            'testpassword',
             $this->dayCollection()
        );
    }


    private function dayCollection()
    {
        $this->dayCollection;
    }

    private function user()
    {
        return $this->user;
    }

    private function userId()
    {
        return $this->userId;
    }
}
