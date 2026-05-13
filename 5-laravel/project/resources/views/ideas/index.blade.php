<x-layout>
    <div class="py-8">
        <h2 class="text-xl font-bold mb-4">Your Ideas</h2>

        @if($ideas->count())
            <div class="grid grid-cols-2 gap-4">
                @foreach($ideas as $idea)
                    <x-idea-card href="/ideas/{{ $idea->id }}">
                        {{ $idea->description }}
                    </x-idea-card>
                @endforeach
            </div>
        @else
            <p class="text-sm opacity-60">No ideas yet.</p>
        @endif

        <a href="/ideas/create" class="inline-block mt-6 text-sm underline underline-offset-2">Create a new one.</a>
    </div>
</x-layout>
