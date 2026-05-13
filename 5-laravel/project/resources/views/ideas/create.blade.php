<x-layout title="New Idea">
    <div class="py-12">
        <h2 class="text-lg font-semibold mb-3 px-1">New Idea</h2>

        <div class="card bg-base-100 border border-base-300 shadow-sm">
            <div class="card-body gap-4">
                <form method="POST" action="/ideas">
                    @csrf

                    <div>
                        <label for="description" class="label text-sm font-medium mb-1">Description</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Your Idea"
                            class="textarea textarea-bordered w-full @error('description') textarea-error @enderror"></textarea>

                        @error('description')
                            <p class="text-xs text-error mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-neutral w-full mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
