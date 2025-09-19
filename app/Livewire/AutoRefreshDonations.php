<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;

class AutoRefreshDonations extends Component
{
    public bool $autoRefresh = true;

    public function mount(): void
    {
        $this->autoRefresh = Session::get('auto_refresh') ?? true;
    }

    public function render(): View
    {
        return view('livewire.auto-refresh-donations');
    }

    public function save(): void
    {
        Session::put('auto_refresh', $this->autoRefresh);
    }
}
