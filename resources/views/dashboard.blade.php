<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 grow flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3  shrink-0 ">
            <div
                class="relative overflow-hidden rounded-xl h-36 flex justify-around align-middle border border-neutral-200 dark:border-neutral-700">
                <livewire:total-donations/>
            </div>
            <div
                class="relative overflow-hidden flex rounded-xl h-36 border border-neutral-200 dark:border-neutral-700">
                <livewire:twitch-viewers-count/>
            </div>
            <div
                class="relative overflow-hidden flex rounded-xl h-36 border border-neutral-200 dark:border-neutral-700">
                <livewire:unprocessed-donations/>
            </div>
        </div>
        <div class="relative  flex-1 w-full shrink-0 ">
            <div
                class="absolute h-full w-full overflow-y-scroll hidden md:block rounded-xl border border-neutral-200 dark:border-neutral-700">
                <livewire:index-donations/>
            </div>
        </div>
    </div>
</x-layouts.app>
