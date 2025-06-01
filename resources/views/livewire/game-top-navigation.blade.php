<x-filament-widgets::widget>
    <x-filament::section>
        <div class="bg-gray-800 text-white">
            <div class="container mx-auto px-1 sm:px-2">
                <div class="flex flex-col sm:flex-row items-center justify-between py-1 gap-2">
                    <!-- Time Information -->
                    <div class="flex items-center space-x-4">
                        <livewire-date-counter :game="$game"/>
                        <livewire-timer :game="$game"/>
                    </div>

                    <!-- Resources -->
                    <div wire:poll="updateGoods" class="flex flex-col space-y-4">
                        @foreach($resources as $key => $items)
                            <div class="flex items-center space-x-4">
                                @foreach($items as $item)
                                    <div class="flex items-center">
                                        <span class="mr-3">{{ $item->icon }}</span>
                                        <span>{{ $item->value ?? '0' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
