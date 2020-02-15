<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Facades\Tests\Setup\UserFactory;

class UserUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_an_associated_social_account()
    {
        $user = UserFactory::withSocialAccount()->create();

        $this->assertEquals($user->socialAccounts()->count(), 1);
    }
}
