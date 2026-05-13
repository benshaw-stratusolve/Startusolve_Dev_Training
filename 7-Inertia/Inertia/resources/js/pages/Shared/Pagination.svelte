<script lang="ts">
    import { Link } from '@inertiajs/svelte';

    type PaginationLink = { url: string | null; label: string; active: boolean };

    const { links } = $props<{ links: PaginationLink[] }>();

    const pageLinks = $derived(links.filter((l) => !isNaN(Number(l.label))));
    const prev = $derived(links.find((l) => l.label.includes('Previous')));
    const next = $derived(links.find((l) => l.label.includes('Next')));
</script>

<div class="mt-6 flex items-center justify-center gap-1">
    {#if prev?.url}
        <Link href={prev.url} class="rounded px-3 py-1 text-sm text-gray-600 hover:bg-gray-100">
            &laquo;
        </Link>
    {/if}

    {#each pageLinks as link (link.label)}
        {#if link.url}
            <Link
                href={link.url}
                class="rounded px-3 py-1 text-sm {link.active ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-100 dark:text-white'}"
            >
                {link.label}
            </Link>
        {/if}
    {/each}

    {#if next?.url}
        <Link href={next.url} class="rounded px-3 py-1 text-sm text-gray-600 hover:bg-gray-100">
            &raquo;
        </Link>
    {/if}
</div>
