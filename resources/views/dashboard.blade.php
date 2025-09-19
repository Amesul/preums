@php
    use Illuminate\Support\Facades\Session;
@endphp
<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 grow flex-col gap-4 rounded-xl">
        <div class="grid shrink-0 auto-rows-min gap-4 md:grid-cols-4">
            <div
                    class="relative flex h-36 justify-around overflow-hidden rounded-xl border border-neutral-400 bg-neutral-50 align-middle dark:border-neutral-600 dark:bg-slate-800"
            >
                <livewire:total-donations />
            </div>
            <div
                    class="relative flex h-36 overflow-hidden rounded-xl border border-neutral-400 bg-neutral-50 dark:border-neutral-600 dark:bg-slate-800"
            >
                <livewire:twitch-viewers-count />
            </div>
            <div
                    class="relative flex h-36 overflow-hidden rounded-xl border border-neutral-400 bg-neutral-50 dark:border-neutral-600 dark:bg-slate-800"
            >
                <livewire:unprocessed-donations />
            </div>
            <div
                    class="relative flex h-36 overflow-hidden rounded-xl border border-neutral-400 bg-neutral-50 dark:border-neutral-600 dark:bg-slate-800"
            >
                <div class="m-auto text-center text-5xl font-black">
                    <h1
                            class="mb-4 text-center text-2xl font-bold text-neutral-900 dark:text-neutral-100"
                    >
                        Rafraichissement automatique
                    </h1>
                    <p>{{ Session::get('auto_refresh', true) ? 'Activé' : 'Désactivé' }}</p>
                </div>


            </div>
        </div>
        <div class="relative w-full flex-1 shrink-0">
            <div
                    class="absolute hidden h-full w-full overflow-y-scroll rounded-xl border border-neutral-400 md:block dark:border-neutral-600"
            >
                <livewire:index-donations />
            </div>
        </div>
    </div>
</x-layouts.app>
