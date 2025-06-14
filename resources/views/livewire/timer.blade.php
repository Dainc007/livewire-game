<div wire:poll.1s="refreshTimer" class="flex items-center space-x-4">
    <div class="flex items-center space-x-2">
        <span class="text-xl">⏱️</span>
        <span class="text-xl font-mono text-gray-900 dark:text-white">{{$time->format('H:i:s')}}</span>
    </div>

    <div class="flex items-center space-x-2">
        @if($game->status === 'running')
            <button type="button" wire:click="updateGameStatus('paused')" class="text-gray-900 dark:text-white hover:text-gray-600 dark:hover:text-gray-300">⏸️</button>
        @else
            <button type="button" wire:click="updateGameStatus('running')" class="text-gray-900 dark:text-white hover:text-gray-600 dark:hover:text-gray-300">▶️</button>
        @endif
    </div>
</div>
