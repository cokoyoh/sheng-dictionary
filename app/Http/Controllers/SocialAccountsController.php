<?php

namespace App\Http\Controllers;

use App\Sheng\Users\SocialAccountsRepository;
use App\Sheng\Users\UsersRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountsController extends Controller
{
    protected $usersRepository;
    protected $socialAccountsRepository;

    /**
     * SocialAccountsController constructor.
     * @param $usersRepository
     * @param $socialAccountsRepository
     */
    public function __construct(
        UsersRepository $usersRepository,
        SocialAccountsRepository $socialAccountsRepository
    ) {
        $this->usersRepository = $usersRepository;
        $this->socialAccountsRepository = $socialAccountsRepository;
    }


    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /*
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return  redirect()->route('login.social', $provider);
        }

        $socialAccount = $this->socialAccountsRepository->getSocialAccountByUserAndProvider($providerUser, $provider);

        if ($socialAccount) {
            $user = $socialAccount->user;
        } else {
            $user = $this->usersRepository->getUserFromProviderUser($providerUser);

            $user->addSocialAccount(['provider_id' => $providerUser->getId(), 'provider_name' => $provider]);
        }

        Auth::login($user, true);

        return redirect()->intended('/home');
    }
}
