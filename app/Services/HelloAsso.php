<?php

namespace App\Services;

use App\Models\HelloassoToken;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;

class HelloAsso
{
    /**
     * @throws ConnectionException
     */
    public static function refreshToken(): HelloassoToken|RedirectResponse|Redirector
    {
        $token = HelloassoToken::all()
                               ->first();

        $res = Http::asForm()
                   ->post(config('helloasso.oauth_url'), [
                       'client_id'     => config('helloasso.client_id'),
                       'grant_type'    => 'refresh_token',
                       'refresh_token' => $token->refresh_token,
                   ]);
        if ($res->status() === 200) {
            $res = $res->json();
            $token->update([
                'access_token'  => $res['access_token'],
                'expires_at'    => now()->addSeconds($res['expires_in']),
                'refresh_token' => $res['refresh_token']
            ]);
            return $token;
        } elseif ($res->status() === 400 || $res->status() === 403) {
            $token?->delete();
            return self::getToken();
        } else {
            throw new ConnectionException($res->getReasonPhrase(), $res->status());
        }
    }

    /**
     * @throws ConnectionException
     */
    public static function getToken(): HelloassoToken
    {
        $res = Http::asForm()
                   ->post(config('helloasso.oauth_url'), [
                       'grant_type'    => 'client_credentials',
                       'client_id'     => config('helloasso.client_id'),
                       'client_secret' => config('helloasso.client_secret'),
                   ]);
        if ($res->status() === 200) {
            $jsonRes = $res->json();
            $token = [
                'access_token'  => $jsonRes['access_token'],
                'expires_at'    => now()->addSeconds($jsonRes['expires_in']),
                'refresh_token' => $jsonRes['refresh_token'],
            ];
            return HelloassoToken::create($token);
        } else {
            throw new ConnectionException($res->getReasonPhrase(), $res->status());
        }
    }
}
