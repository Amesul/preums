<section class="w-full">
    @include("partials.settings-heading")

    <x-settings.layout
        :heading="__('Dons')"
        :subheading=" __('Mettre à jour les paramètres d\'affichage des dons.')"
    >
        <flux:radio.group x-data variant="segmented" wire:model="perPage">
            <flux:radio value="10" label="10" wire:click="save" />
            <flux:radio value="20" label="20" wire:click="save" />
            <flux:radio value="50" label="50" wire:click="save" />
        </flux:radio.group>
    </x-settings.layout>
</section>
