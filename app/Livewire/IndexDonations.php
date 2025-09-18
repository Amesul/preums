<?php

namespace App\Livewire;

use App\Livewire\Settings\Pagination;
use App\Models\Donation;
use App\Services\DonationsProcessor;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class IndexDonations extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * @throws ConnectionException
     */
    public function mount(): void
    {
        $this->processDonations();
    }

    /**
     * @return void
     * @throws ConnectionException
     */
    protected function processDonations(): void
    {
        $data = DonationsProcessor::fetch();
        DonationsProcessor::store($data['donations'], $data['continuation_token']);
        $this->dispatch('fetch-donations')
             ->to(TotalDonations::class);
        $this->dispatch('unprocessed-donation-update')
             ->to(UnprocessedDonations::class);
    }

    public function render(): View
    {
        return view('livewire.index-donations', [
            'donations' => Donation::orderBy('timestamp', 'desc')
                                   ->paginate(auth()->user()->pagination_setting->value ?? 20),
        ]);
    }

    public function processDonation(Donation $donation, bool $button = false): void
    {
        if ($button) {
            $donation->update(['processed' => !$donation->processed]);
        } else {
            $donation->update(['processed' => true]);
        }
        $this->dispatch('unprocessed-donation-update')
             ->to(UnprocessedDonations::class);

    }

    /**
     * @throws ConnectionException
     */
    public function refresh(): void
    {
        $this->processDonations();
    }
}
