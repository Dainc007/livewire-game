<div class="w-full h-full">
    <!-- Game Grid -->
    <div class="grid grid-cols-8 gap-1 h-full">
        @for ($i = 0; $i < 64; $i++)
            <div class="aspect-square bg-gray-100 border border-gray-200 rounded hover:bg-gray-200 cursor-pointer transition-colors">
                <!-- Grid cell content will go here -->
            </div>
        @endfor
    </div>
</div> 