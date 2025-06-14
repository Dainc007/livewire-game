<div wire:poll="refreshDate" class="flex items-center">
    <div class="flex items-center flex-wrap gap-1 sm:gap-2 text-sm sm:text-base text-gray-900 dark:text-white">
        <span>Year {{ $year }}</span>
        <span>{{ $isDay ? '☀️' : '🌙' }}</span>
        <span>{{ $isDay ? 'Day' : 'Night' }}</span>
        <span class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">(Day {{ $dayCount }})</span>
        <span>
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
        <span>{{ ucfirst($season) }}</span>
    </div>
</div>
