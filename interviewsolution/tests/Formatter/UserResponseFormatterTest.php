<?php

namespace App\Tests\Formatter;

use App\Entity\User;
use App\Formatter\UserResponseFormatter;
use PHPUnit\Framework\TestCase;

class UserResponseFormatterTest extends TestCase
{
    public function testFormat()
    {
        $userMock = $this->createMock(User::class);
        $userMock->method('toArray')->willReturn(['id' => 1, 'username' => 'testuser']);

        $formatter = new UserResponseFormatter();
        $result = $formatter->format([$userMock]);

        $this->assertEquals([['id' => 1, 'username' => 'testuser']], $result);
    }
}
