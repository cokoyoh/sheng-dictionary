<?php


namespace App\Sheng\Users;


use App\User;

class UsersRepository
{
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function save(array $attributes)
    {
        return User::create($attributes);
    }

    public function getUserFromProviderUser($providerUser)
    {
        $user = $this->getUserByEmail($providerUser->getEmail());

        if ($user) {
            return $user;
        }

        $providerUserEmail = $providerUser->getEmail();

        $user = $this->save([
            'email' => $providerUserEmail,
            'name' => $providerUser->getName() ?? $providerUser->getNickname(),
            'avatar_url' => $providerUser->getAvatar()
        ]);

        if($providerUserEmail) {
            $user->markEmailAsVerified();
        }

        return $user;
    }
}
