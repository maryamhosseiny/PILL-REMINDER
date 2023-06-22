<?php

namespace App\Providers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Auth::viaRequest('jwt', function (Request $request) {
            try{
                $token = $request->bearerToken();
                if($token) {
                    $tokenPayload = JWT::decode($request->bearerToken(), new Key(config('jwt.key'), 'HS256'));
                    $user_id = ($tokenPayload->id);
                    return \App\Models\User::find($user_id);
                }
                return null;
            } catch(\Exception $th){
                Log::error($th);
                return null;
            }
        });
    }


}
