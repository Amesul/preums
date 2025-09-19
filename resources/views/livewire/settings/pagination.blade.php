<section class="w-full">
    @include("partials.settings-heading")

    <x-settings.layout
            :heading="__('Dons')"
            :subheading=" __('Mettre à jour les paramètres d\'affichage des dons.')"
    >
        <div class="space-y-8">
            <flux:radio.group x-data variant="segmented" wire:model="perPage" description="Nombre de dons par page">
                <flux:radio value="10" label="10" wire:click="save" />
                <flux:radio value="20" label="20" wire:click="save" />
                <flux:radio value="50" label="50" wire:click="save" />
            </flux:radio.group>

            <flux:separator />

            <livewire:auto-refresh-donations />
        </div>

    </x-settings.layout>
</section>
