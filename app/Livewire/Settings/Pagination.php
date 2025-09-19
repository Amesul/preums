<?php

namespace App\Livewire\Settings;

use Illuminate\View\View;
use Livewire\Component;

class Pagination extends Component
{
    public $perPage;

    public function mount(): void
    {
        $this->perPage = auth()
            ->user()
            ->pagination_setting->value ?? 20;
    }

    public function render(): View
    {
        return view('livewire.settings.pagination');
    }

    public function save(): void
    {
        auth()
            ->user()
            ->pagination_setting()
            ->updateOrCreate(['user_id' => auth()->user()->id], ['value' => $this->perPage]);
    }
}
