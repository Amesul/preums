<div class="text-center font-black text-5xl m-auto">
    <h1 class="text-center mb-4 text-2xl font-bold text-neutral-900 dark:text-neutral-100">
        Viewers
    </h1>
    <p wire:poll.visible.15s="refresh">{{ $viewers }}</p>
</div>
