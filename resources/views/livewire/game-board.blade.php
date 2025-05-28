<div>
    <div class="hexagon-map" id="map">
        @foreach($map as $colIndex => $column)
            <div class="column">
                @foreach($column as $rowIndex => $hexagon)
                    <div
                        id="{{ $hexagon['id'] }}"
                        class="hexagon {{ $hexagon['type'] }}"
                        @if($hexagon['icon']) style="--icon: '{{ $hexagon['icon'] }}';" @endif
                    ></div>
                @endforeach
            </div>
        @endforeach
    </div>

<style>
    .hexagon {
        width: var(--hexagon-size);
        height: 98px;
        position: relative;
        background: #FCB503;
        transition: background 0.25s ease;
        overflow: hidden;
        clip-path: polygon(0% 25%, 0% 75%, 50% 100%, 100% 75%, 100% 25%, 50% 0%);
        cursor: pointer;

        --hexagon-size: 86px;
        --duration: 0.45s;
        --gap: 12px;

    }

    @property --index {
        syntax: "<number>";
        initial-value: 0;
        inherits: true;
    }

    @property --ripple-factor {
        syntax: "<number>";
        initial-value: 0;
        inherits: true;
    }

    .hexagon-map {
        display: flex;
        position: relative;
        align-items: flex-start;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .hexagon-map .column {
        display: grid;
        flex-direction: column;
        align-items: flex-start;
        gap: 63px;
    }

    .hexagon-map .column:nth-child(odd) {
        margin-top: 80px;
        margin-left: -40px;
    }

    .hexagon-map .column:nth-child(even) {
        margin-left: -40px;
    }



    @media (hover) {
        .hexagon:hover {
            background: #252525;
        }

        .hexagon:hover:after {
            color: #FCB503;
        }
    }

    .hexagon:after {
        content: var(--icon);
        display: grid;
        place-items: center;
        position: absolute;
        font-size: 14px;
        inset: 0;
        color: #fff;
        transition: color 0.25s ease;
    }

    .hexagon.clicked {
        z-index: -1;
    }

    .hexagon.grey {
        background: #FAF7EE;
        pointer-events: none;
        z-index: -2;
    }

    .hexagon.bord {
        background: transparent;
        background: #FAF7EE;
        pointer-events: none;
        z-index: -2;
    }

    .hexagon.bord:after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: calc(100% - 4px);
        height: calc(100% - 4px);
        background: #fff;
        clip-path: polygon(0% 25%, 0% 75%, 50% 100%, 100% 75%, 100% 25%, 50% 0%);
    }

    .hexagon.hide {
        visibility: hidden;
    }

    @keyframes ripple {
        from {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(max(0.8, calc(var(--ripple-factor) / 100)));
            opacity: 0.42;
        }

        65% {
            opacity: 1;
            background: #FCB503;
        }
        70% {
            transform: scale(1.5);
            background: #FCB503;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .hexagon-map.show-ripple .anima {
        pointer-events: none;
        cursor: default;
        background: #FCB503;
        --duration: 0.45s;
        animation: ripple var(--duration) ease-in-out;
        animation-duration: max(
            var(--duration),
            calc(var(--duration) * var(--ripple-factor) / 100)
        );
        animation-delay: calc(var(--ripple-factor) * 8ms);
    }

    .hexagon-map.show-ripple .anima:after {
        color: #fff;
    }
</style>

<script>
    (() => {
        const container = document.getElementById("map");
        const hexagons = Array.from(container.querySelectorAll(".anima"));
        const distances = new Array(hexagons.length);
        const elements = hexagons.slice();

        const calculateDistances = (targetRect) => {
            let maxDistance = 0;
            elements.forEach((element, index) => {
                const rect = element.getBoundingClientRect();
                const distance = Math.hypot(rect.x - targetRect.x, rect.y - targetRect.y);
                distances[index] = distance; // Store the distance
                maxDistance = Math.max(maxDistance, distance); // Find the maximum distance
            });
            return maxDistance;
        };

        const applyRippleEffect = (maxDistance) => {
            const applyStyles = () => {
                elements.forEach((element, index) => {
                    const rippleFactor = (distances[index] / maxDistance) * 100;
                    element.style.setProperty("--ripple-factor", rippleFactor.toFixed(2));
                });
            };

            // Use requestAnimationFrame to update styles
            requestAnimationFrame(applyStyles);
        };

        const ripple = (target, isClick = true) => {
            if (container.classList.contains("show-ripple")) return;

            const targetRect = target ? target.getBoundingClientRect() : { x: 0, y: 0 };

            // Add class to clicked element if it exists and this is a click
            if (isClick && target) {
                target.classList.add("clicked");
            }

            const maxDistance = calculateDistances(targetRect);
            container.classList.add("show-ripple");

            applyRippleEffect(maxDistance);

            const maxElement = elements[distances.indexOf(maxDistance)];
            maxElement.addEventListener("animationend", () => {
                container.classList.remove("show-ripple");
                elements.forEach((element) => {
                    element.style.removeProperty("--ripple-factor");
                    if (isClick && target) element.classList.remove("clicked");
                });
            }, { once: true }); // Use once for automatic removal of the handler
        };

        const startAnimationFromCenter = () => {
            const containerRect = container.getBoundingClientRect();
            const offsetX = -40; // negative offset for even columns
            const offsetY = 80; // padding-top
            const centerX = containerRect.x + (containerRect.width / 2) + offsetX;
            const centerY = containerRect.y + (containerRect.height / 2) - offsetY;

            // Call ripple with center coordinates, passing false for isClick
            ripple({ getBoundingClientRect: () => ({ x: centerX, y: centerY }) }, false);
        };

        // Start animation when page loads
        window.addEventListener("load", startAnimationFromCenter);

        hexagons.forEach((hexagon) => {
            hexagon.addEventListener("click", () => ripple(hexagon));
        });
    })();
</script>
</div>
