<?php

namespace App\Livewire;

use App\Models\Donation;
use App\Service\DonationsProcessor;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class IndexDonations extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render(): View
    {
        return view('livewire.index-donations', [
            'donations' => Donation::orderBy('timestamp', 'desc')->paginate(20),
        ]);
    }

    public function processDonation(Donation $donation): void
    {
        $donation->update(['processed' => !$donation->processed]);
        $this->dispatch('donation-processed')->to(UnprocessedDonations::class);
    }

    /**
     * @throws ConnectionException
     */
    public function refresh(): void
    {
        $data = DonationsProcessor::fetch();
        DonationsProcessor::store($data['donations'], $data['continuation_token']);
    }
}
