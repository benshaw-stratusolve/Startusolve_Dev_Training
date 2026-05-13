<x-layout title="Idea">
    <div class="py-8">
        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body gap-4">
                <h2 class="card-title text-xl">Your Idea</h2>

                <p class="text-base leading-relaxed">{{ $idea->description }}</p>

                <div class="divider my-0"></div>

                <div class="flex gap-2">
                    <a href="/ideas/{{ $idea->id }}/edit" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/ideas" class="btn btn-ghost btn-sm">← Back</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
