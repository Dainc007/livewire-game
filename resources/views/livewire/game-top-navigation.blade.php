<x-filament-widgets::widget>
    <x-filament::section>
    <div class="bg-gray-800 text-white">
    <div class="container mx-auto px-2 sm:px-4">
        <div class="flex flex-col sm:flex-row items-center justify-between py-2">
            <!-- Time Information -->
            <div class="flex items-center space-x-2 sm:space-x-4 mb-2 sm:mb-0">
                <livewire-date-counter :game="$game"/>
                <livewire-timer :game="$game"/>
            </div>

            <!-- Resources -->
            <div class="flex flex-col sm:flex-row items-center space-y-1 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
                <div wire:poll="updateGoods"  class="flex items-center space-x-2 sm:space-x-4">
                    @foreach($user['good'] as $item)
                        <livewire:top-navigation-item :item="$item" :key="$item->id" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    </x-filament::section>
</x-filament-widgets::widget>
