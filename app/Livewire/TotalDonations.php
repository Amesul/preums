<?php

namespace App\Livewire;

use App\Models\Donation;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class TotalDonations extends Component
{
    public int $total;

    public function mount(): void
    {
        $this->total = Donation::sum('amount');
    }

    public function render(): View
    {
        return view('livewire.total-donations');
    }

    #[On('fetch-donations')]
    public function refresh(): void
    {
        $this->total = Donation::sum('amount');
    }
}
