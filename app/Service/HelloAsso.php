<?php

namespace App\Service;

use App\Models\HelloassoToken;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class HelloAsso
{
    /**
     * @throws ConnectionException
     */
    public static function refreshToken(): HelloassoToken
    {
        $token = HelloassoToken::where('invalidated', '=', false)->first();
        $res = Http::asForm()
            ->post('https://api.helloasso-sandbox.com/oauth2/token', [
                'client_id' => config('helloasso.client_id'),
                'grant_type' => 'refresh_token',
                'refresh_token' => $token?->refresh_token,
            ]);
        if ($res->status() !== 200) {
            $token?->update([
                'invalidated' => true,
            ]);
            return self::getToken();
        } else {
            $res = $res->json();
            $token->update([
                'access_token' => $res['access_token'],
                'expires_at' => now()->addSeconds($res['expires_in']),
            ]);
            return $token;
        }
    }

    /**
     * @throws ConnectionException
     */
    public static function getToken(): HelloassoToken
    {
        $res = Http::asForm()
            ->post('https://api.helloasso-sandbox.com/oauth2/token', [
                'grant_type' => 'client_credentials',
                'client_id' => config('helloasso.client_id'),
                'client_secret' => config('helloasso.client_secret'),
            ])
            ->json();

        return HelloassoToken::create([
            'access_token' => $res['access_token'],
            'refresh_token' => $res['refresh_token'],
            'expires_at' => now()->addSeconds($res['expires_in']),
            'invalidated' => false,
        ]);
    }
}
