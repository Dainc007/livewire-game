<div wire:poll="refreshDate">
    <!-- Year -->
    <div class="flex items-center space-x-2">
        <span class="text-xl">📅</span>
        <span class="text-xl">Year {{ $year }}</span>
    </div>

    <!-- Day/Night -->
    <div class="flex items-center space-x-2">
        <span class="text-xl">{{ $isDay ? '☀️' : '🌙' }}</span>
        <span class="text-xl">{{ $isDay ? 'Day' : 'Night' }}</span>
        <span class="text-sm">(Day {{ $dayCount }})</span>
    </div>

    <!-- Season -->
    <div class="flex items-center space-x-2">
                    <span class="text-xl">
                        @switch($season)
                            @case('spring')
                                🌱
                                @break
                            @case('summer')
                                ☀️
                                @break
                            @case('autumn')
                                🍂
                                @break
                            @case('winter')
                                ❄️
                                @break
                        @endswitch
                    </span>
        <span class="text-xl">{{ ucfirst($season) }}</span>
    </div>
</div>
