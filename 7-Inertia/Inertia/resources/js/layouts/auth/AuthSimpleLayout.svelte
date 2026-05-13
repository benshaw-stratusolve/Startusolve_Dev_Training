<script lang="ts">
    import type { Snippet } from 'svelte';

    let {
        title = '',
        description = '',
        children,
    }: {
        title?: string;
        description?: string;
        children?: Snippet;
    } = $props();
</script>

<div class="relative flex min-h-svh flex-col items-center justify-center overflow-hidden bg-white p-6 md:p-10">

    <!-- Fake users page in background -->
    <div class="pointer-events-none absolute inset-0 select-none blur-sm brightness-90 scale-105">
        <div class="mx-auto max-w-4xl px-8 py-10">
            <div class="mb-4 h-9 w-24 rounded bg-gray-800"></div>
            <div class="mb-4 h-4 w-20 rounded bg-blue-400"></div>
            <div class="mb-4 h-10 w-full rounded-lg border border-gray-200 bg-gray-50"></div>
            <ul class="divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200">
                {#each Array(7) as _, i}
                    <li class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-indigo-{(i % 4) * 100 + 200}"></div>
                            <div class="h-4 w-32 rounded bg-gray-300"></div>
                        </div>
                        <div class="h-4 w-10 rounded bg-indigo-300"></div>
                    </li>
                {/each}
            </ul>
            <div class="mt-4 flex justify-center gap-2">
                {#each Array(4) as _}
                    <div class="h-8 w-8 rounded bg-gray-200"></div>
                {/each}
            </div>
        </div>
    </div>

    <!-- Glass card -->
    <div class="relative z-10 w-full max-w-sm">
        <div class="rounded-2xl border border-white/40 bg-white/30 p-8 shadow-2xl backdrop-blur-md">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-gray-900">{title}</h1>
                <p class="mt-1 text-sm text-gray-600">{description}</p>
            </div>
            {@render children?.()}
        </div>
    </div>
</div>
