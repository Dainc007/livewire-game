<x-filament-widgets::widget>
    <x-filament::section>
        <div class="hexagon-map" id="map">
            @foreach($map as $colIndex => $column)
                <div class="column {{ $colIndex % 2 === 0 ? 'even' : 'odd' }}">
                    @foreach($column as $rowIndex => $hexagon)
                        <div
                            wire:click="triggerBuildModal({{ $hexagon['id'] }})"
                            id="{{ $hexagon['id'] }}"
                            class="{{ $hexagon['classes'] }}"
                            style="--icon: '{{ $hexagon['icon'] }}'; --delay: {{ ($colIndex * 16 + $rowIndex) * 10 }}ms"
                        ></div>
                    @endforeach
                </div>
            @endforeach
        </div>

<style>
    .hexagon-map {
        display: flex;
        position: relative;
        align-items: flex-start;
        padding: 2rem;
        width: 100%;
        overflow: auto;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        border-radius: 12px;
        box-shadow: inset 0 4px 12px rgba(0, 0, 0, 0.3);
        min-height: 500px;
    }

    .column {
        display: grid;
        gap: 4rem;
        margin-left: -2.5rem;
        animation: columnSlideIn 0.4s ease-out;
        animation-delay: calc(var(--column-index, 0) * 25ms);
        animation-fill-mode: both;
    }

    .column.odd {
        margin-top: 5rem;
    }

    .hexagon {
        --size: 86px;
        width: var(--size);
        height: calc(var(--size) * 1.15);
        position: relative;
        cursor: pointer;
        clip-path: polygon(0% 25%, 0% 75%, 50% 100%, 100% 75%, 100% 25%, 50% 0%);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: hexagonAppear 0.4s ease-out;
        animation-delay: var(--delay);
        animation-fill-mode: both;
        transform-origin: center;
        opacity: 0;
        pointer-events: auto;
        z-index: 1;
    }

    .hexagon::before {
        content: '';
        position: absolute;
        inset: 2px;
        border-radius: inherit;
        clip-path: inherit;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        z-index: 1;
        transition: opacity 0.3s ease;
        opacity: 0;
        pointer-events: none;
    }

    .hexagon::after {
        content: var(--icon);
        display: grid;
        place-items: center;
        position: absolute;
        inset: 0;
        font-size: 1.2rem;
        z-index: 2;
        transition: all 0.3s ease;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        pointer-events: none;
    }

    /* Field Type Styles with Gradients and Animations */
    .field-grass {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        box-shadow: 0 4px 8px rgba(34, 197, 94, 0.3);
    }

    .field-water {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }

    .field-mountain {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
    }

    .field-forest {
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        box-shadow: 0 4px 8px rgba(22, 163, 74, 0.3);
    }

    .field-desert {
        background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%);
        box-shadow: 0 4px 8px rgba(234, 179, 8, 0.3);
    }

    .field-swamp {
        background: linear-gradient(135deg, #65a30d 0%, #4d7c0f 100%);
        box-shadow: 0 4px 8px rgba(101, 163, 13, 0.3);
    }

    .field-tundra {
        background: linear-gradient(135deg, #b5d7e3 0%, #0891b2 100%);
        box-shadow: 0 4px 8px rgba(6, 182, 212, 0.3);
    }

    /* Ambient Animations - Applied after entrance */
    .field-grass.loaded {
        animation: grassSway 4s ease-in-out infinite;
    }

    .field-water.loaded {
        animation: waterShimmer 3s ease-in-out infinite;
    }

    .field-mountain.loaded {
        animation: mountainGlow 5s ease-in-out infinite;
    }

    .field-forest.loaded {
        animation: forestSway 4s ease-in-out infinite;
    }

    .field-desert.loaded {
        animation: desertHeat 5s ease-in-out infinite;
    }

    .field-swamp.loaded {
        animation: swampBubble 6s ease-in-out infinite;
    }

    .field-tundra.loaded {
        animation: tundraFreeze 4s ease-in-out infinite;
    }

    /* Enhanced Hover Effects - Works for ALL field types */
    .hexagon:hover {
        transform: scale(1.15) translateY(-10px) rotate(2deg);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.5);
        z-index: 10;
        filter: brightness(1.2) saturate(1.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hexagon:hover::before {
        opacity: 1;
    }

    .hexagon:hover::after {
        transform: scale(1.3);
        text-shadow: 0 0 15px rgba(255, 255, 255, 0.9);
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.5));
    }

    /* Click Animation */
    .hexagon:active {
        transform: scale(0.9) rotate(-1deg);
        transition: transform 0.1s ease;
    }

    /* Keyframe Animations */
    @keyframes columnSlideIn {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes hexagonAppear {
        0% {
            opacity: 0;
            transform: scale(0) rotate(180deg);
        }
        60% {
            opacity: 1;
            transform: scale(1.1) rotate(-10deg);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
    }

    @keyframes grassSway {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(0.5deg); }
        75% { transform: rotate(-0.5deg); }
    }

    @keyframes waterShimmer {
        0%, 100% {
            filter: brightness(1) hue-rotate(0deg);
        }
        50% {
            filter: brightness(1.1) hue-rotate(5deg);
        }
    }

    @keyframes mountainGlow {
        0%, 100% {
            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
        }
        50% {
            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.5), 0 0 20px rgba(245, 158, 11, 0.2);
        }
    }

    @keyframes forestSway {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(0.8deg); }
        75% { transform: rotate(-0.8deg); }
    }

    @keyframes desertHeat {
        0%, 100% {
            filter: brightness(1) saturate(1);
        }
        50% {
            filter: brightness(1.15) saturate(1.2);
        }
    }

    @keyframes swampBubble {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.02);
        }
    }

    @keyframes tundraFreeze {
        0%, 100% {
            filter: brightness(1) contrast(1);
            box-shadow: 0 4px 8px rgba(6, 182, 212, 0.3);
        }
        50% {
            filter: brightness(1.1) contrast(1.1);
            box-shadow: 0 4px 8px rgba(6, 182, 212, 0.5), 0 0 15px rgba(6, 182, 212, 0.2);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hexagon {
            --size: 60px;
        }

        .column {
            gap: 2.5rem;
            margin-left: -1.5rem;
        }

        .column.odd {
            margin-top: 3rem;
        }

        .hexagon-map {
            padding: 1rem 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .hexagon {
            --size: 45px;
        }

        .hexagon::after {
            font-size: 0.9rem;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {
        .hexagon,
        .column {
            animation: none;
        }

        .field-water,
        .field-forest,
        .field-desert,
        .field-swamp,
        .field-tundra {
            animation: none;
        }

        .hexagon:hover {
            transform: scale(1.05);
        }
    }
</style>
    </x-filament::section>
</x-filament-widgets::widget>
