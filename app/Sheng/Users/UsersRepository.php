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

        $user = $this->save([
            'email' => $providerUser->getEmail(),
            'name' => $providerUser->getName(),
        ]);

        return $user;
    }
}
