@props([
    'name' => 'required'
])

@error('description')
    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
@enderror