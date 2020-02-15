<?php


namespace Tests\Setup;


use App\SocialAccount;
use App\User;

class UserFactory
{
    private $socialAccount;

    public function create()
    {
        $user = create(User::class);

        $this->socialAccount ? $this->socialAccount->update(['user_id' => $user->id]) : null;

        return $user;
    }

    public function withSocialAccount($socialAccount = null)
    {
        $socialAccount = $socialAccount ?? create(SocialAccount::class);

        $this->socialAccount = $socialAccount;

        return $this;
    }
}
