<x-filament-widgets::widget>
    <x-filament::section>
        <div class="bg-gray-800 text-white">
            <div class="container mx-auto px-2 sm:px-4">
                <div class="flex flex-col sm:flex-row items-center justify-between py-2 gap-2">
                    <!-- Time Information -->
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <livewire-date-counter :game="$game"/>
                        <livewire-timer :game="$game"/>
                    </div>

                    <!-- Resources -->
                    <div wire:poll.3s="updateGoods" class="flex flex-wrap items-center gap-x-3 gap-y-1 sm:gap-x-4">
                        @if($resources && $resources->isNotEmpty())
                            @foreach($resources as $key => $items)
                                @if($items && $items->isNotEmpty())
                                    @foreach($items as $item)
                                        @if($item && isset($item->icon) && isset($item->value))
                                            <div class="flex items-center space-x-1">
                                                <span class="text-sm">{{ $item->icon }}</span>
                                                <span class="text-xs sm:text-sm font-medium">{{ $item->value }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <div class="text-xs text-gray-400">No resources available</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
