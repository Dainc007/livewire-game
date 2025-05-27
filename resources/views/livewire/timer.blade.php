<div wire:poll.1s="refreshTimer" class="flex items-center space-x-4">
    <div class="flex items-center space-x-2">
        <span class="text-xl">⏱️</span>
        <span class="text-xl font-mono">{{$time->format('H:i:s')}}</span>
    </div>

    <div class="flex items-center space-x-2">
        @if($game->status === 'running')
            <button type="button" wire:click="updateGameStatus('paused')">⏸️</button>
        @else
            <button type="button" wire:click="updateGameStatus('running')">▶️</button>
        @endif
    </div>
</div>
