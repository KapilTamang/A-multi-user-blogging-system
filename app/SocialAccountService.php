<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Socialite\Contracts\User as ProviderUser; 

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $provider) {
        
        $account = SocialAccount::whereProviderName($provider)->whereProviderUserId($providerUser->getId())->first();

        if($account) {
            
            return $account->user;
        }
        else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider_name' => $provider
            ]);
            
            $user = User::whereEmail($providerUser->getEmail())->first();

            if(!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'role_id' => 3,
                 ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }
    }
}
