<?php

namespace App\Livewire;

use App\Models\Donation;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class UnprocessedDonations extends Component
{
    public int $total;

    public function mount(): void
    {
        $this->total = Donation::where('processed', false)->count();
    }

    public function render(): View
    {
        return view('livewire.unprocessed-donations');
    }

    #[On('unprocessed-donation-update')]
    public function refreshTotal(): void
    {
        $this->total = Donation::where('processed', false)->count();
    }
}
