<?php

namespace App\Livewire;

use App\Models\Donation;
use Illuminate\View\View;
use Livewire\Component;

class DonationsWidget extends Component
{
    public $total = 0;

    public function mount(): void
    {
        $sum = Donation::all()
                       ->sum('amount') / 100;
        $this->total = number_format($sum, 2, ',', ' ');
    }

    public function render(): View
    {
        return view('livewire.donations-widget');
    }
}
