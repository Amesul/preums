@php
    use Carbon\Carbon;
@endphp

<div class="px-4 sm:px-6 lg:px-8" wire:poll.keep-alive.10s="refresh">
    <div class="flow-root">
        <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <table
                        class="min-w-full border-separate border-spacing-0 bg-white dark:bg-gray-800"
                >
                    <thead>
                    <tr>
                        <th
                                scope="col"
                                class="dark:border-wh2te/10 sticky top-0 z-10 border-b border-gray-300 bg-teal-700 py-3.5 pr-3 pl-4 text-center text-sm font-semibold text-gray-200 backdrop-blur-sm backdrop-brightness-90 sm:pl-6 lg:pl-8 dark:bg-teal-300 dark:text-neutral-900"
                        >
                            Date
                        </th>
                        <th
                                scope="col"
                                class="dark:border-wh2te/10 sticky top-0 z-10 border-b border-gray-300 bg-teal-700 px-2 py-3.5 text-center text-sm font-semibold text-gray-200 backdrop-blur-sm backdrop-brightness-90 sm:table-cell dark:bg-teal-300 dark:text-neutral-900"
                        >
                            Pseudo
                        </th>
                        <th
                                scope="col"
                                class="dark:border-wh2te/10 sticky top-0 z-10 border-b border-gray-300 bg-teal-700 px-2 py-3.5 text-center text-sm font-semibold text-gray-200 backdrop-blur-sm backdrop-brightness-90 lg:table-cell dark:bg-teal-300 dark:text-neutral-900"
                        >
                            Montant
                        </th>
                        <th
                                scope="col"
                                class="sm dark:border-wh2te/10 sticky top-0 z-10 border-b border-gray-300 bg-teal-700 px-2 py-3.5 text-center text-sm font-semibold text-gray-200 backdrop-blur-sm backdrop-brightness-90 dark:bg-teal-300 dark:text-neutral-900"
                        >
                            Message
                        </th>
                        <th
                                scope="col"
                                class="dark:border-wh2te/10 sticky top-0 z-10 border-b border-gray-300 bg-teal-700 py-3.5 pr-4 pl-3 text-center backdrop-blur-sm backdrop-brightness-90 sm:pr-6 lg:pr-8 dark:bg-teal-300"
                        >
                            <flux:button
                                    icon="arrow-path"
                                    size="xs"
                                    wire:click="refresh"
                            />
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($donations as $donation)
                        @php
                            $date = Carbon::parse($donation->timestamp);
                            if (now()->subHours(1) > $date) {
                                $formattedDate = $date->translatedFormat("D \à H:i");
                            } else {
                                $formattedDate = $date->subHours(2)->diffForHumans();
                            }
                        @endphp

                        <tr
                                class="{{ $donation->processed ? "" : "hover:bg-gray-300/20 dark:hover:bg-gray-300/10" }} transition"
                        >
                            <td
                                    wire:click="processDonation({{ $donation->id }})"
                                    class="w-content {{ $donation->processed ? "text-gray-500/55 dark:text-neutral-300/50" : "text-gray-400 dark:text-gray-400" }} relative z-0 h-full border-b border-gray-200 py-3 pr-3 pl-4 text-xs whitespace-nowrap sm:pl-6 lg:pl-8 dark:border-white/10"
                            >
                                {{ $formattedDate }}
                                <div
                                        class="{{ $donation->processed ? "bg-neutral-50/65 dark:bg-slate-800/65" : "" }} absolute top-0 left-0 z-10 h-full w-full"
                                ></div>
                            </td>
                            <td
                                    wire:click="processDonation({{ $donation->id }})"
                                    class="w-content {{ $donation->processed ? "text-gray-600/50 dark:text-gray-200/50" : "text-gray-600 dark:text-gray-200" }} relative z-0 h-full border-b border-gray-200 px-2 py-3 text-right font-black tracking-wide whitespace-nowrap sm:table-cell dark:border-white/10"
                            >
                                {{ $donation->username ?? "Anonyme" }}
                                <div
                                        class="{{ $donation->processed ? "bg-neutral-50/65 dark:bg-slate-800/65" : "" }} absolute top-0 left-0 z-10 h-full w-full"
                                ></div>
                            </td>
                            <td
                                    wire:click="processDonation({{ $donation->id }})"
                                    class="w-content {{ $donation->processed ? "text-gray-600/50 dark:text-gray-200/50" : "text-gray-600 dark:text-gray-200" }} relative z-0 h-full border-b border-gray-200 px-2 py-3 text-center whitespace-nowrap lg:table-cell dark:border-white/10"
                            >
                                {{ $donation->formatted_amount }}
                                <div
                                        class="{{ $donation->processed ? "bg-neutral-50/65 dark:bg-slate-800/65" : "" }} absolute top-0 left-0 z-10 h-full w-full"
                                ></div>
                            </td>
                            <td
                                    wire:click="processDonation({{ $donation->id }})"
                                    class="w-content {{ $donation->processed ? "text-gray-600/50 dark:text-gray-200/50" : "text-gray-600 dark:text-gray-200" }} relative z-0 h-full border-b border-gray-200 px-2 py-3 dark:border-white/10"
                            >
                                {{ $donation->message }}
                                <div
                                        class="{{ $donation->processed ? "bg-neutral-50/65 dark:bg-slate-800/65" : "" }} absolute top-0 left-0 z-10 h-full w-full"
                                ></div>
                            </td>
                            <td
                                    class="h-full border-b border-gray-200 py-3 pr-4 pl-3 text-center font-medium whitespace-nowrap text-gray-600 sm:pr-8 lg:pr-8 dark:border-white/10 dark:text-gray-200"
                            >
                                <flux:button
                                        icon="check-circle"
                                        variant="subtle"
                                        size="xs"
                                        wire:click="processDonation({{ $donation->id }}, true)"
                                />
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-8 py-3">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</div>
