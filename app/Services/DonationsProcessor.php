<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\HelloassoToken;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class DonationsProcessor extends Controller
{
    /**
     * @throws ConnectionException
     */
    public static function store($fetchedDonations, $token): void
    {
        $latestDonation = donation::orderBy('timestamp', 'desc')
                                  ->first();
        $newDonations = new Collection();
        self::processFetchedDonations($fetchedDonations, $latestDonation, $newDonations, $token);
        foreach ($newDonations as $donation) {
            Donation::create($donation);
        }
    }

    /**
     * @param $fetchedDonations
     * @param Donation|null $latestDonation
     * @param Collection $newDonations
     * @param string $token
     * @return Collection
     * @throws ConnectionException
     */
    public static function processFetchedDonations($fetchedDonations, ?Donation $latestDonation, Collection $newDonations, string $token): Collection
    {
        $index = 1;
        foreach ($fetchedDonations as $donation) {
            if ($latestDonation?->id === $donation['id']) return $newDonations;

            $username = null;
            $message = null;

            if (array_key_exists('customFields', $donation['items'][0])) {
                foreach ($donation['items'][0]['customFields'] as $field) {
                    switch($field['id']) {
                        case '6237146':
                            $username = $field['answer'];
                            break;
                        case '6237147':
                            $message = $field['answer'];
                            break;
                    }
                }
            }
            $newDonations->push([
                'id'        => $donation['id'],
                'timestamp' => strtotime($donation['date']),
                'username'  => $username,
                'message'   => $message,
                'amount'    => $donation['amount']['total'],
                'processed' => false
            ]);
            if (count($fetchedDonations) === $index) {
                $data = self::fetch($token);
                self::processFetchedDonations($data['donations'], $latestDonation, $newDonations, $data['continuation_token']);
            }
            $index++;
        }
        return $newDonations;
    }

    /**
     * @throws ConnectionException
     */
    public static function fetch(?string $continuationToken = null): array
    {
        $token = HelloassoToken::all()
                               ->first();

        if (!$token) {
            $token = HelloAsso::getToken();
        }
        if (now()->greaterThan($token->expires_at->subSeconds(30))) {
            $token = HelloAsso::refreshToken();
        }

        $res = Http::withToken($token?->access_token)
                   ->get(config('helloasso.api_base_url') . '/organizations/capgame/forms/Donation/2/orders', [
                       'pageIndex'         => 1,
                       "pageSize"          => 10,
                       "withCount"         => "false",
                       "withDetails"       => "true",
                       'continuationToken' => $continuationToken ?? ''
                   ]);
        $donations = [];
        if ($res->status() === 200) {
            $res = $res->json();
            $continuationToken = $res["pagination"]["continuationToken"];
            $donations = $res["data"];
        } elseif ($res->status() === 401) {
            HelloAsso::refreshToken();
            self::fetch();
        } else {
            throw new ConnectionException($res->getReasonPhrase(), $res->status());
        }
        return [
            "donations"          => $donations,
            "continuation_token" => $continuationToken
        ];
    }
}
