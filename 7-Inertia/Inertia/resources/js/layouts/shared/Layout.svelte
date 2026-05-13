<script lang="ts">
    import { page } from '@inertiajs/svelte';
    import type { Snippet } from 'svelte';
    import Nav from './Nav.svelte';
    import { themeState, updateAppearance } from '@/lib/theme.svelte';

    let { children }: { children?: Snippet } = $props();

    const user = $derived(page.props.auth.user);
    const theme = themeState();

    function toggleTheme() {
        const next = theme.resolvedAppearance() === 'dark' ? 'light' : 'dark';
        updateAppearance(next);
    }
</script>

<Nav />

<header class="flex items-center justify-between px-6 py-4 bg-white dark:bg-gray-900 text-black dark:text-white">
    <div>
        {#if user}
            <p>Welcome back, {user.name}!</p>
        {/if}
    </div>
    <button
        onclick={toggleTheme}
        class="rounded border border-gray-300 dark:border-gray-600 px-3 py-1.5 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white"
    >
        {theme.resolvedAppearance() === 'dark' ? '☀ Light' : '☾ Dark'}
    </button>
</header>

<main class="min-h-screen bg-white dark:bg-gray-900 text-black dark:text-white">
    {@render children?.()}
</main>


