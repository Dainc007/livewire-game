<div class="bg-gray-800 text-white p-4">
    <div class="container mx-auto">
        <div class="flex items-center justify-between">
            <!-- Time Information -->
            <div class="flex items-center space-x-6">
               <livewire-date-counter :game="$game"/>
                <livewire-timer :game="$game"/>
            </div>

            <!-- Resources -->
            <div class="flex items-center space-x-6">
                @foreach($goods as $good)
                    <livewire:top-navigation-item :good="$good" :key="$good->id" />
                @endforeach
            </div>
        </div>
    </div>
</div>
