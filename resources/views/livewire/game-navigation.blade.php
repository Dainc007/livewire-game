<div class="container mx-auto">
    <div class="flex justify-between items-center mb-2">
        <h1 class="text-2xl font-bold">Settlement Builder</h1>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <span class="text-yellow-400">⏱️</span>
                <span id="timer" class="font-mono">00:00:00</span>
            </div>
            <div id="timerControls">
                <button id="startTimer" class="px-2 py-1 bg-green-500 rounded hover:bg-green-600 text-sm hidden">
                    ▶️
                </button>
                <button id="pauseTimer" class="px-2 py-1 bg-yellow-500 rounded hover:bg-yellow-600 text-sm">
                    ⏸️
                </button>
            </div>
        </div>
    </div>
    <div class="flex justify-end space-x-6">
        <div class="flex items-center space-x-2">
            <span class="text-yellow-400">💰</span>
            <span>{{ $gold }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-purple-400">🎭</span>
            <span>{{ $culture }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-blue-400">📚</span>
            <span>{{ $knowledge }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-gray-400">🪵</span>
            <span>{{ $wood }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-red-600">🪨</span>
            <span>{{ $stone }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-blue-400">👥</span>
            <span>{{ $population }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-green-400">😊</span>
            <span>{{ $happiness }}%</span>
        </div>
    </div>
</div>

<script>
    // Timer functionality
    let startTime = localStorage.getItem('gameStartTime') ? parseInt(localStorage.getItem('gameStartTime')) : Date.now();
    let pausedTime = localStorage.getItem('gamePausedTime') ? parseInt(localStorage.getItem('gamePausedTime')) : 0;
    let isPaused = localStorage.getItem('gameIsPaused') === 'true';
    let timerInterval;

    function updateTimer() {
        const currentTime = isPaused ? pausedTime : Date.now();
        const elapsed = currentTime - startTime;
        const hours = Math.floor(elapsed / 3600000);
        const minutes = Math.floor((elapsed % 3600000) / 60000);
        const seconds = Math.floor((elapsed % 60000) / 1000);
        
        document.getElementById('timer').textContent = 
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function toggleTimerButtons() {
        const startButton = document.getElementById('startTimer');
        const pauseButton = document.getElementById('pauseTimer');
        
        if (isPaused) {
            startButton.classList.remove('hidden');
            pauseButton.classList.add('hidden');
        } else {
            startButton.classList.add('hidden');
            pauseButton.classList.remove('hidden');
        }
    }

    function startTimer() {
        if (isPaused) {
            startTime = Date.now() - (pausedTime - startTime);
            localStorage.setItem('gameStartTime', startTime.toString());
        }
        isPaused = false;
        localStorage.setItem('gameIsPaused', 'false');
        localStorage.removeItem('gamePausedTime');
        timerInterval = setInterval(updateTimer, 1000);
        toggleTimerButtons();
    }

    function pauseTimer() {
        isPaused = true;
        pausedTime = Date.now();
        localStorage.setItem('gameIsPaused', 'true');
        localStorage.setItem('gamePausedTime', pausedTime.toString());
        clearInterval(timerInterval);
        toggleTimerButtons();
    }

    // Initialize timer state
    document.getElementById('startTimer').addEventListener('click', startTimer);
    document.getElementById('pauseTimer').addEventListener('click', pauseTimer);

    // Set initial button state
    toggleTimerButtons();

    // Start timer if not paused
    if (!isPaused) {
        startTimer();
    } else {
        updateTimer();
    }
</script> 