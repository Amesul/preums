<div class="m-auto text-center text-5xl font-black">
    <h1
        class="mb-4 text-center text-2xl font-bold text-neutral-900 dark:text-neutral-100"
    >
        Viewers
    </h1>
    <p wire:poll.visible.15s="refresh">{{ $viewers }}</p>
</div>
