<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 grow flex-col gap-4 rounded-xl">
        <div class="grid shrink-0 auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative flex h-36 justify-around overflow-hidden rounded-xl border border-neutral-400 bg-neutral-50 align-middle dark:border-neutral-700"
            >
                <livewire:total-donations />
            </div>
            <div
                class="relative flex h-36 overflow-hidden rounded-xl border border-neutral-400 bg-neutral-50 dark:border-neutral-700"
            >
                <livewire:twitch-viewers-count />
            </div>
            <div
                class="relative flex h-36 overflow-hidden rounded-xl border border-neutral-400 bg-neutral-50 dark:border-neutral-700"
            >
                <livewire:unprocessed-donations />
            </div>
        </div>
        <div class="relative w-full flex-1 shrink-0">
            <div
                class="absolute hidden h-full w-full overflow-y-scroll rounded-xl border border-neutral-400 bg-neutral-50 md:block dark:border-neutral-700"
            >
                <livewire:index-donations />
            </div>
        </div>
    </div>
</x-layouts.app>
