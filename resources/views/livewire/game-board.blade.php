<x-filament-widgets::widget>
    <x-filament::section>
{{--    <livewire-game-top-navigation :game="$game"/>--}}
    <h1 wire:show="showModal" class="text-2xl font-bold text-center mb-4">test {{ $selectedField }}</h1>

    <div class="hexagon-map" id="map" style="height:500px;">
        @foreach($map as $colIndex => $column)
            <div class="column {{ $colIndex % 2 === 0 ? 'even' : 'odd' }}">
                @foreach($column as $rowIndex => $hexagon)
                    <div
                        wire:click="triggerBuildModal({{ $hexagon['id'] }})"
                        id="{{ $hexagon['id'] }}"
                        class="{{ $hexagon['classes'] }}"
                    ></div>
                @endforeach
            </div>
        @endforeach
    </div>

<style>
    .hexagon {
        --hexagon-size: 86px;
        --duration: 0.45s;
        --gap: 12px;

        width: var(--hexagon-size);
        height: 98px;
        position: relative;
        background: #FCB503;
        transition: background 0.25s ease;
        overflow: hidden;
        clip-path: polygon(0% 25%, 0% 75%, 50% 100%, 100% 75%, 100% 25%, 50% 0%);
        cursor: pointer;
    }

    .hexagon:after {
        content: var(--icon);
        display: grid;
        place-items: center;
        position: absolute;
        font-size: 14px;
        inset: 0;
        transition: color 0.25s ease;
    }

    .hexagon-map {
        display: flex;
        position: relative;
        align-items: flex-start;
        padding: 50px 0;
        width: 100%;
        overflow: auto;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .hexagon-map .column {
        display: grid;
        flex-direction: column;
        align-items: flex-start;
        gap: 63px;
        margin-left: -40px;
    }

    .hexagon-map .column.odd {
        margin-top: 80px;
    }

    @media (hover) {
        .hexagon:hover {
            background: #252525;
        }
        .hexagon:hover:after {
            color: #FCB503;
        }
    }

    .hexagon.clicked { z-index: -1; }
    .hexagon.grey, .hexagon.bord {
        background: #FAF7EE;
        pointer-events: none;
        z-index: -2;
    }

    .hexagon.bord:after {
        content: '';
        position: absolute;
        inset: 2px;
        background: #fff;
        clip-path: polygon(0% 25%, 0% 75%, 50% 100%, 100% 75%, 100% 25%, 50% 0%);
    }

    .hexagon.hide { visibility: hidden; }

    @keyframes ripple {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(max(0.8, calc(var(--ripple-factor) / 100))); opacity: 0.42; }
        65% { opacity: 1; background: #FCB503; }
        70% { transform: scale(1.5); background: #FCB503; }
        100% { transform: scale(1); opacity: 1; }
    }

    .hexagon-map.show-ripple .anima {
        pointer-events: none;
        cursor: default;
        background: #FCB503;
        animation: ripple var(--duration) ease-in-out;
        animation-duration: max(var(--duration), calc(var(--duration) * var(--ripple-factor) / 100));
        animation-delay: calc(var(--ripple-factor) * 8ms);
    }

    .hexagon-map.show-ripple .anima:after {
        color: #fff;
    }
</style>

<script>
    const map = document.getElementById("map");
    const hexagons = Array.from(map.querySelectorAll(".anima"));
    const distances = new Array(hexagons.length);

    function adjustContainerHeight(height) {
        map.style.height = `${height}px`;
        document.getElementById("heightValue").textContent = `${height}px`;
    }

    function adjustContainerWidth(width) {
        map.style.width = `${width}%`;
        document.getElementById("widthValue").textContent = `${width}%`;
    }

    function calculateDistances(targetRect) {
        return Math.max(...hexagons.map((element, index) => {
            const rect = element.getBoundingClientRect();
            return distances[index] = Math.hypot(rect.x - targetRect.x, rect.y - targetRect.y);
        }));
    }

    function applyRippleEffect(maxDistance) {
        requestAnimationFrame(() => {
            hexagons.forEach((element, index) => {
                element.style.setProperty("--ripple-factor", ((distances[index] / maxDistance) * 100).toFixed(2));
            });
        });
    }

    function ripple(target, isClick = true) {
        if (map.classList.contains("show-ripple")) return;

        const targetRect = target ? target.getBoundingClientRect() : { x: 0, y: 0 };
        if (isClick && target) target.classList.add("clicked");

        const maxDistance = calculateDistances(targetRect);
        map.classList.add("show-ripple");
        applyRippleEffect(maxDistance);

        const maxElement = hexagons[distances.indexOf(maxDistance)];
        maxElement.addEventListener("animationend", () => {
            map.classList.remove("show-ripple");
            hexagons.forEach(element => {
                element.style.removeProperty("--ripple-factor");
                if (isClick && target) element.classList.remove("clicked");
            });
        }, { once: true });
    }

    function startAnimationFromCenter() {
        const rect = map.getBoundingClientRect();
        const centerX = rect.x + (rect.width / 2) - 40;
        const centerY = rect.y + (rect.height / 2) - 80;
        ripple({ getBoundingClientRect: () => ({ x: centerX + map.scrollLeft, y: centerY + map.scrollTop }) }, false);
    }

    window.addEventListener("load", startAnimationFromCenter);
    hexagons.forEach(hexagon => hexagon.addEventListener("click", () => ripple(hexagon)));
</script>
    </x-filament::section>
</x-filament-widgets::widget>
