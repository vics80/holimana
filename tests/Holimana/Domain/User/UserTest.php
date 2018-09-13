<?php

namespace Tests\Holimana\Domain;

use Holimana\Domain\DomainEventPublisher;
use Holimana\Domain\User\User;
use Holimana\Domain\User\UserFactory;
use Holimana\Domain\Day\DayCollectionFactory;
use Holimana\Domain\User\UserId;
use Holimana\Domain\User\UserIdFactory;
use Holimana\Domain\User\UserInvalidArgumentsException;
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
        $this->user = new User(
            $this->userId(),
            'Víctor',
            'Garcia',
            'victorvgm@gmail.com',
            'testpassword',
            (new \DateTime())->setDate(
                1980,
                5,
                3
            ),
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
        $this->assertSame('testpassword', $this->user()->plainPassword());
        $this->assertSame($this->dayCollection(), $this->user()->days());
    }

    /**
     * @test
     * @expectedException \Holimana\Domain\User\UserInvalidArgumentsException
     */
    public function tryToCreateUserWithEmptyFirstname()
    {
        new User(
            new UserId(),
            null,
            'lastname',
            'an@email.com',
            '1234',
            new \DateTime()
        );
    }

    /**
     * @test
     * @expectedException \Holimana\Domain\User\UserInvalidArgumentsException
     * @dataProvider nonValidEmailProvider
     */
    public function tryToCreateUserWithNonValidEmail($email)
    {
        new User(
            new UserId(),
            'firstname',
            'lastname',
            $email,
            '1234',
            new \DateTime()
        );
    }

    public function nonValidEmailProvider()
    {
        return [
            ['example'],
            ['example@'],
            ['@example'],
            ['example@example'],
            ['example.com'],
            ['example@.'],
            ['@.'],
            ['@example.com'],
        ];
    }

    /**
     * @test
     * @expectedException \Holimana\Domain\User\UserInvalidArgumentsException
     * @dataProvider nonValidLengthPasswordProvider
     */
    public function tryToCreateUserWithNonValidLengthPassword($password)
    {
        new User(
            new UserId(),
            'firstname',
            'lastname',
            'an@email.com',
            $password,
            new \DateTime()
        );
    }

    public function nonValidLengthPasswordProvider()
    {
        return [
            ['1234567'],
            ['111111111111111111111111111111111']
        ];
    }

    public function tryToAddDays()
    {
//        $user = $this->getUser();
//        $user->setDays($user->days()->add);
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
