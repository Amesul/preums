<div>
    <flux:fieldset>
        <flux:legend>{{ __('Activer le rafraîchissement automatique') }}</flux:legend>

        <div class="space-y-3">
            <flux:switch :label="__('Auto-refresh')" align="left" wire:model="autoRefresh" wire:change="save" />
        </div>
    </flux:fieldset>
</div>