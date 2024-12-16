<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testExample()
    {
        $user = new User;
        $this->assertInstanceOf(User::class, $user);
    }

    public function testAssert()
    {
        $user = User::factory()->create(['name' => 'test']);
        $this->assertTrue(is_string($user->email));
        $this->assertFalse(is_null($user->password));
        $this->assertEquals($user->name, 'test');
        $this->assertNull($user->test);
        $this->assertEmpty($user->username);
    }
}
