@php use Carbon\Carbon; @endphp

<div class="px-4 sm:px-6 lg:px-8" wire:poll.30s="refresh">
    <div class="flow-root">
        <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <table class="min-w-full border-separate border-spacing-0">
                    <thead>
                    <tr>
                        <th scope="col"
                            class="sticky top-0 z-10 border-b border-gray-300 bg-white py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-brightness-90 sm:pl-6 lg:pl-8 dark:border-wh2te/10 dark:bg-gray-900 dark:text-white">
                            Date
                        </th>
                        <th scope="col"
                            class="sticky top-0 z-10 border-b border-gray-300 bg-white px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-brightness-90 sm:table-cell dark:border-wh2te/10 dark:bg-gray-900 dark:text-white">
                            Pseudo
                        </th>
                        <th scope="col"
                            class="sticky top-0 z-10 border-b border-gray-300 bg-white px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-brightness-90 lg:table-cell dark:border-wh2te/10 dark:bg-gray-900 dark:text-white">
                            Montant
                        </th>
                        <th scope="col"
                            class="sticky top-0 z-10 border-b border-gray-300 bg-white px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur-sm backdrop-brightness-90 sm dark:border-wh2te/10 dark:bg-gray-900 dark:text-white">
                            Message
                        </th>
                        <th scope="col"
                            class="sticky top-0 z-10 border-b border-gray-300 bg-white py-3.5 pr-4 pl-3 backdrop-blur-sm backdrop-brightness-90 sm:pr-6 lg:pr-8 dark:border-wh2te/10 dark:bg-gray-900">
                            <flux:button icon="arrow-path" size="xs" variant="primary" wire:click="refresh"/>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($donations as $donation)
                        <tr>
                            <td class="{{ $donation->processed ? 'text-gray-900/25 dark:text-white/25 bg-gray-200/10' : 'text-gray-900 dark:text-white' }} border-b border-gray-200 py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap  sm:pl-6 lg:pl-8 dark:border-white/10">
                                {{ Carbon::parse($donation->timestamp)->translatedFormat('D \à H:i') }}                        </td>
                            <td class="{{ $donation->processed ? 'text-gray-600/25 dark:text-gray-300/25 bg-gray-200/10' : 'text-gray-600 dark:text-gray-300' }} border-b border-gray-200 px-3 py-4 text-sm whitespace-nowrap  sm:table-cell dark:border-white/10">
                                {{ $donation->username }}
                            </td>
                            <td class="{{ $donation->processed ? 'text-gray-600/25 dark:text-gray-300/25 bg-gray-200/10' : 'text-gray-600 dark:text-gray-300' }} border-b border-gray-200 px-3 py-4 text-sm whitespace-nowrap  lg:table-cell dark:border-white/10">
                                {{ $donation->amount }} €
                            </td>
                            <td class="{{ $donation->processed ? 'text-gray-600/25 dark:text-gray-300/25 bg-gray-200/10' : 'text-gray-600 dark:text-gray-300' }} border-b border-gray-200 px-3 py-4 text-sm dark:border-white/10">
                                {{ $donation->message }}
                            </td>
                            <td class="{{ $donation->processed ? 'text-gray-600/25 dark:text-gray-300/25 bg-gray-200/10' : 'text-gray-600 dark:text-gray-300' }} border-b border-gray-200 py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-8 lg:pr-8 dark:border-white/10">
                                <flux:button icon="check-circle" variant="subtle" size="xs"
                                             wire:click="processDonation({{ $donation->id }})"/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="py-3 px-8">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</div>
