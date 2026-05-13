<a {{ $attributes->merge(['class' => 'card bg-base-100 hover:bg-base-200 transition-colors duration-150 cursor-pointer']) }}>
    <div class="card-body">
        <p class="text-base">{{ $slot }}</p>
    </div>
</a>
