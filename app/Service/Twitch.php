<?php

namespace App\Service;

use App\Models\TwitchToken;
use Illuminate\Support\Facades\Http;

class Twitch
{
    public static function GetViewerCount(): int
    {
        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . TwitchToken::where('invalidated', '=', false)->first()?->access_token,
            'Client-Id' => config('twitch.client_id'),
        ])
            ->withQueryParameters([
                'user_login' => 'misterjday',
            ])
            ->get(config('twitch.base_url') . '/streams');
        if ($res->status() === 200) {
            $res = $res->json();
            return $res['data'][0]['viewer_count'];
        } elseif ($res->status() === 401) {
            TwitchToken::where('invalidated', '=', false)->first()?->update(['invalidated' => true]);
            self::GetAppAccessToken();
            return self::GetViewerCount();
        } else {
            return 0;
        }
    }

    public static function GetAppAccessToken(): TwitchToken
    {
        $res = Http::asForm()->post('https://id.twitch.tv/oauth2/token', [
            'client_id' => config('twitch.client_id'),
            'client_secret' => config('twitch.client_secret'),
            'grant_type' => 'client_credentials',
        ]);
        $res = $res->json();
        return TwitchToken::create([
            'access_token' => $res['access_token'],
            'expires_at' => now()->addSeconds($res['expires_in']),
        ]);
    }
}
