<?php


namespace App\Sheng\Users;


use App\SocialAccount;

class SocialAccountsRepository
{
    public function getSocialAccountByUserAndProvider($providerUser, $provider)
    {
        return SocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();
    }

    public function save(array $attributes)
    {
        return SocialAccount::create($attributes);
    }
}
