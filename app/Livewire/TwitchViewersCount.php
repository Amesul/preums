<?php

namespace App\Livewire;

use App\Services\Twitch;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class TwitchViewersCount extends Component
{
    public int|string $viewers = 0;

    public function mount(): void
    {
        $this->viewers = Twitch::GetViewerCount();
    }

    public function render(): View
    {
        return view('livewire.twitch-viewers-count');
    }

    public function refresh(): void
    {
        $this->viewers = Twitch::GetViewerCount();
    }
}
